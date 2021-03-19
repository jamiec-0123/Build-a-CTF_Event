FROM alpine:latest
EXPOSE 22

# Install openssh
RUN apk add --no-cache openssh

# Setup S6 Overlay
COPY misc/s6-overlay-amd64.tar.gz /
RUN tar xzf /s6-overlay-amd64.tar.gz -C /

# Setup SSH
RUN ssh-keygen -t dsa -f /etc/ssh/ssh_host_dsa_key
RUN ssh-keygen -t rsa -b 4096 -f /etc/ssh/ssh_host_rsa_key
RUN adduser -D -s /bin/sh -h /home/john john

COPY --chown=john:john conf/john /home/john/.ssh/id_rsa

COPY --chown=john:john conf/john.pub /home/john/.ssh/id_rsa.pub

COPY --chown=john:john conf/john.pub /home/john/.ssh/authorized_keys

RUN chmod 640 /home/john/.ssh/authorized_keys
RUN chmod 600 /home/john/.ssh/id_rsa
RUN chmod 640 /home/john/.ssh/id_rsa.pub

RUN chmod +s /usr/bin/find

ENTRYPOINT ["/init"]
