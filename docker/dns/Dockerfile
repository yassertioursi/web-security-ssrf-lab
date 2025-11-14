FROM python:3.11-alpine

WORKDIR /app

# Install dnslib
RUN pip install --no-cache-dir dnslib

# Copy DNS server script
COPY dns_server.py /app/

EXPOSE 53/udp

CMD ["python", "-u", "dns_server.py"]
