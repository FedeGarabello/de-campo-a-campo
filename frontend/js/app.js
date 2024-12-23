document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('#productosTable tbody');
    

    const fetchProductos = () => {
        apiFetch('/products', 'GET')
            .then((products) => {
                tableBody.innerHTML = '';
                products.forEach((product) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${product.id}</td>
                        <td>${product.name}</td>
                        <td>${product.description}</td>
                        <td>$ ${product.price}</td>
                        <td>$ ${product.usd_price}</td>
                        <td class="actions-container">
                            <a href="pages/edit_product.html?id=${product.id}" class="button edit-btn"><i class="fa-regular fa-pen-to-square"></i>Editar</a>
                            <button class="delete-btn" data-id="${product.id}"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });

                // Configurar botones de eliminar
                document.querySelectorAll('.delete-btn').forEach((button) => {
                    button.addEventListener('click', (e) => {
                        const id = e.target.dataset.id;
                        if (confirm('¿Estás seguro de eliminar este producto?')) {
                            apiFetch(`/products/${id}`, 'DELETE')
                                .then(() => {
                                    showMessage('Producto eliminado exitosamente.', 'success');
                                    fetchProductos();
                                })
                                .catch(() => {
                                    showMessage('Error al eliminar el producto.', 'error');
                                });
                        }
                    });
                });
            })
            .catch(() => {
                showMessage('Error al cargar los productos.', 'error');
            });
    };

    fetchProductos();
});