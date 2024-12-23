CREATE TABLE IF NOT EXISTS products (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `description` TEXT,
    `price` DECIMAL(10,2),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Cepillo de Dientes', 'Cepillo biodegradable', 1000.00, NOW(), NOW()),
(2, 'Bolsas biodegradables', 'Bolsas degradables en Agua x 10', 900.00, NOW(), NOW()),
(3, 'Shampoo solido', 'Shampoo en barra', 8000.00, NOW(), NOW()),
(4, 'Acondicionador solido', 'Acondicionador solido', 7500.00, NOW(), NOW());