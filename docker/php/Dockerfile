FROM alpine:latest
EXPOSE 80

# Install php-fpm
RUN apk add --no-cache php-fpm

# Setup S6 Overlay
COPY misc/s6-overlay-amd64.tar.gz /
RUN tar xzf /s6-overlay-amd64.tar.gz -C /

# Install caddy-server
COPY misc/caddy-server /bin/caddy
RUN mkdir /var/www && \
    mkdir /run/php && \
    adduser -D -s /bin/sh -h /var/www www-data && \
    chmod 777 /bin/caddy

# Cleanup
RUN rm -rf /s6-overlay-amd64.tar.gz

RUN adduser -D -s /bin/sh -h /home/john john
COPY --chown=john:john conf/john /home/john/.ssh/id_rsa

COPY --chown=john:john conf/john.pub /home/john/.ssh/id_rsa.pub

RUN chmod 666 /home/john/.ssh/id_rsa
RUN chmod 666 /home/john/.ssh/id_rsa.pub

ENTRYPOINT ["/init"]
