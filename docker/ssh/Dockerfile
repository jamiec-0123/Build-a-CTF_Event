FROM ubuntu:20.04
EXPOSE 22

RUN apt-get update

RUN apt-get install -y openssh-server

RUN mkdir /var/run/sshd

RUN echo 'root:FTYhiuIHU4FT7uig38uasdSfw' |chpasswd

RUN useradd -m john

COPY --chown=john:john conf/user.txt /home/john/user.txt

COPY --chown=john:john conf/john /home/john/.ssh/id_rsa
COPY --chown=john:john conf/john.pub /home/john/.ssh/id_rsa.pub
COPY --chown=john:john conf/john.pub /home/john/.ssh/authorized_keys

RUN chmod 600 /home/john/user.txt && \
    chmod 755 /home/john/.ssh && \
    chmod 640 /home/john/.ssh/authorized_keys && \
    chmod 600 /home/john/.ssh/id_rsa && \
    chmod 640 /home/john/.ssh/id_rsa.pub

COPY conf/root.txt /root/root.txt
RUN chmod 600 /root/root.txt

# Privesc
RUN chmod +s /usr/bin/find

CMD ["/usr/sbin/sshd", "-D"]
