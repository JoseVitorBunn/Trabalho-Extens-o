# Trabalho-Extensão

Script Banco de dados;

CREATE TABLE models (
    id SERIAL PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
