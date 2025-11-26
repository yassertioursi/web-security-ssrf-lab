# Laravel SSRF Vulnerability Lab

![Warning](https://img.shields.io/badge/⚠️-Educational%20Only-red)
![Docker](https://img.shields.io/badge/Docker-Required-blue)
![Laravel](https://img.shields.io/badge/Laravel-11.x-orange)

Educational lab environment for learning **Server-Side Request Forgery (SSRF)** attacks in realistic scenarios.

## ⚠️ WARNING

**THIS APPLICATION CONTAINS INTENTIONAL VULNERABILITIES**

- 🚫 DO NOT deploy in production
- 🚫 DO NOT expose to the internet
- ✅ Use ONLY in isolated environments
- ✅ For educational purposes only

---

## 🎯 What You'll Learn

### **Lab 1: Basic SSRF**
- URL fetching without validation
- Accessing internal services
- Gopher protocol exploitation
- Redis protocol smuggling → RCE
- PoC : https://github.com/yassertioursi/web-security-ssrf-lab/blob/master/SSRF_SIMPLE_POC.md 

### **Lab 2: Blind SSRF**
- Error-based detection
- Time-based port scanning
- Service discovery without response data
- PoC  : https://github.com/yassertioursi/web-security-ssrf-lab/blob/master/SSRF_BLIND_POC.md

### **Lab 3: DNS Rebinding**
- TOCTOU (Time-of-Check-Time-of-Use) exploitation
- Bypassing IP-based validation
- DNS rebinding attacks
- https://github.com/yassertioursi/web-security-ssrf-lab/blob/master/dns_rebinding_exploit.py

---

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose
- 1GB+ free RAM

### Installation

```bash

git clone https://github.com/yassertioursi/laravel-ssrf-lab.git
cd laravel-ssrf-lab/ssrf


docker-compose up -d


http://localhost:8000
```

### Verify Installation
```bash
docker-compose ps

```


## 🏗️ Infrastructure

```
┌─────────────────────┐
│   Your Browser      │
│   localhost:8000    │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐    Gopher     ┌─────────────────────┐
│  Laravel App        │──────────────▶│  Redis              │
│  - SSRF endpoints   │               │  - No auth          │
│  - Port 8000        │               │  - Port 6379        │
└─────────────────────┘               └─────────────────────┘
```

**Services:**
- Laravel App (SSRF vulnerable)
- Redis (Gopher protocol target)



## 📝 License

MIT License - For educational use only

**Remember:** Practice ethical hacking. Only test systems you own or have permission to test.

## 📝 License

This project is for **educational purposes only**. Use responsibly.

---

**Remember:** Always practice ethical hacking. Only test systems you have explicit permission to test.
