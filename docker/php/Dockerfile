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

COPY services.d /etc/services.d
COPY php7 /etc/php7
COPY www /var/www

RUN adduser -D -s /bin/sh -h /home/john john

COPY --chown=john:john conf/john /home/john/.ssh/id_rsa
COPY --chown=john:john conf/john.pub /home/john/.ssh/id_rsa.pub
COPY --chown=john:john conf/john.pub /home/john/.ssh/authorized_keys

RUN chmod 666 /home/john/.ssh/id_rsa && \
    chmod 666 /home/john/.ssh/id_rsa.pub && \
    chmod 666 /home/john/.ssh/authorized_keys

COPY --chown=john:john conf/note.txt /home/john/user.txt

RUN chmod 666 /home/john/user.txt

ENTRYPOINT ["/init"]
