FROM mysql:8.0-debian
COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN apt-get update
RUN apt-get install -y locales 
RUN sed -i -e 's/# \(ja_JP.UTF-8\)/\1/' /etc/locale.gen \
  && locale-gen \
  && update-locale LANG=ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8
ENV TZ Asia/Tokyo
ENV LANG=ja_JP.UTF-8
EXPOSE 3306