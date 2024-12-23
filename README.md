# 🐮 De Campo a Campo Challenge

## Project Description

This project is a **REST API** built with **Native PHP** and a simple front end with **Vanilla JS CSS, and HTML**.

---

## 🛠️ Initialize the Project

Follow these steps to set up and run the project, feel free to use the Makefile to run `cmds` in a simpler way:

1. **Build project:**
   ```bash
   docker compose build
   ```

2. **Run project:**
   ```bash
   docker compose up -d
   ```

3. **For using the Makefile commands run:**

    ```bash
    make build
    make up
    ```

4. **For delete and rebuild use**
    ```bash
    docker compose down -v
    or make down
    ```

5. **The aplication will be aviable at:**

    ```bash
    http://localhost:3000/index.html
    ```

---

## 📌 Available Endpoints

| **Method**    | **Endpoint**                            | **Description**                   |
|---------------|-----------------------------------------|-----------------------------------|
| `GET`         | `/api/v1/products/`                     | Get all products                  |
| `GET`         | `/api/v1/products/{id}`                 | Get one product                   |
| `POST`        | `/api/v1/products/`                     | Create a new product              |
| `PUT`         | `/api/v1/products/{id}`                 | Update a product                  |
| `DELETE`      | `/api/v1/products/{id}`                 | Delete a product                  |
