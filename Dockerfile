FROM ubuntu:latest
LABEL authors="author_name"

ENTRYPOINT ["top", "-b"]
