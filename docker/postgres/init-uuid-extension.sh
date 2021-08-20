#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 -U "$POSTGRES_USER" "SELECT 1 FROM pg_database WHERE datname='${POSTGRES_DB}'" | grep -q 1 | psql -U "$POSTGRES_USER" -c "CREATE DATABASE ${POSTGRES_DB}" || echo "error"
psql -v ON_ERROR_STOP=1 -U "$POSTGRES_USER" "SELECT 1 FROM pg_database WHERE datname='${POSTGRES_DB}_test'" | grep -q 1 | psql -U "$POSTGRES_USER" -c "CREATE DATABASE ${POSTGRES_DB}_test" || echo "error"

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
EOSQL

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "${POSTGRES_DB}_test" <<-EOSQL
    CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
EOSQL