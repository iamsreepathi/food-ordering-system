FROM docker.elastic.co/logstash/logstash:8.15.0

# delete default configuration
RUN rm -f /usr/share/logstash/pipeline/logstash.conf

# copy configurations
COPY conf/logstash/pipeline/ /usr/share/logstash/pipeline/
COPY conf/logstash/config/ /usr/share/logstash/config/
