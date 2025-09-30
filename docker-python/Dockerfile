# RecursionCurriculum Python Development Environment
FROM python:3.11-slim

LABEL description="Python 3.11 Development Environment"

# 必要なパッケージインストール
RUN apt-get update && apt-get install -y \
    gcc \
    g++ \
    make \
    git \
    curl \
    vim \
    && rm -rf /var/lib/apt/lists/*

# Pythonパッケージインストール
RUN pip install --no-cache-dir \
    pytest \
    pytest-cov \
    black \
    mypy \
    flake8 \
    pylint \
    flask \
    fastapi \
    uvicorn[standard] \
    requests \
    numpy \
    mysql-connector-python \
    psycopg2-binary

WORKDIR /workspace

EXPOSE 5000 8000

CMD ["python", "-u", "server.py"]