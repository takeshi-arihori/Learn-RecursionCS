# RecursionCurriculum C++ Development Environment
FROM gcc:13

LABEL description="C++ Development Environment with GCC 13, CMake, and Google Test"

# 開発ツールインストール
RUN apt-get update && apt-get install -y \
    cmake \
    make \
    git \
    gdb \
    valgrind \
    libgtest-dev \
    clang-17 \
    clang-format-17 \
    clang-tidy-17 \
    lldb-17 \
    && rm -rf /var/lib/apt/lists/*

# Google Test ビルド
RUN cd /usr/src/gtest && \
    cmake . && \
    make && \
    cp lib/*.a /usr/lib || cp *.a /usr/lib

# CMake最新版インストール
RUN curl -LO https://github.com/Kitware/CMake/releases/download/v3.28.0/cmake-3.28.0-linux-x86_64.sh && \
    sh cmake-3.28.0-linux-x86_64.sh --prefix=/usr/local --skip-license && \
    rm cmake-3.28.0-linux-x86_64.sh

WORKDIR /workspace

CMD ["bash"]