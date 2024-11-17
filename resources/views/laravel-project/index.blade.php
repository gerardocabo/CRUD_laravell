<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body, .container-fluid {
    overflow-x: hidden;
}
.card-product:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}
</style>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">E-Store</a>
    <form class="d-flex" role="search">
    <div class="input-group">
        <span class="input-group-text bg-dark text-white">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <input class="form-control" type="search" placeholder="Search product name" aria-label="Search">
    </div>
    </form>
  </div>
</nav>
@if(session('success'))
    <div class="alert alert-success fade show">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger fade show">
        {{ session('error') }}
    </div>
@endif


<button class="btn btn-dark mt-2 ms-3" onclick="toggleCard()">
    <i class="fa-solid fa-plus"></i> Add New Product
</button>

<div class="row">
    <!-- New Product Form Card -->
    <div class="col" id="newProductCol"> 
            <div class="card d-none ms-1 mt-3" id="productCard" id="productCard" style="box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15); transition: transform 0.3s, box-shadow 0.3s; padding: 20px;">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-center align-items-center">
                        <span class="text-center fw-bold fs-4">New Product</span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('laravel-project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <input type="text" name="product_name" class="form-control" placeholder="Enter the product name" required>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <input type="number" name="product_price" class="form-control" placeholder="Enter the product price" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12 mb-3">
                                <input type="text" name="product_seller" class="form-control" placeholder="Seller/Company Name" required>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12 mb-3">
                                <input type="text" name="product_place" class="form-control" placeholder="Enter the place of factory" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <input type="text" name="product_description" class="form-control" placeholder="Enter the product description">
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <input type="number" name="product_quantity" class="form-control" placeholder="Enter the product quantity" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12 mb-3">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="product_image" name="product_image">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-dark mt-2">ENTER</button>
                        <button type="reset" class="btn btn-sm btn-danger mt-2">CLEAR</button>
                    </form>
                </div>
            </div>
        </div>


    <div class="col-md-12" id="productListCol">
        <div class="card ms-3 me-3 mt-4">
            <div class="card-body">
                <div class="container-fluid mt-1">
                    <div class="row">
                        @foreach($product as $products)
                            <div class="col-4 col-md-4 col-lg-3 mb-3 d-flex">
                                <div class="card h-100 w-100 card-product" data-id="{{ $products->id }}" style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); padding: 10px;">
                                @if($products->product_image)
                                    <img src="{{ asset('storage/' . $products->product_image) }}" class="card-img-top w-100 product-image" alt="{{ $products->product_name }}" style="object-fit: cover; max-height: 150px; cursor: pointer;">
                                @else
                                    <img src="{{ asset('public/storage/products/default-product.jpg') }}" class="card-img-top w-100 product-image" alt="Default Product" style="object-fit: cover; max-height: 150px; cursor: pointer;">
                                @endif
                                <div class="card-body p-2 d-flex flex-column">
                                    <h6 class="fw-bold mb-3" style="font-family: Arial, sans-serif; font-size: 16px; color: #333;">{{ $products->product_name }}</h6>
                                    <span>
                                        <i class="fa-solid fa-star" style="background: linear-gradient(to bottom, #FFD700, #FFA500); -webkit-background-clip: text; color: transparent; font-size: 12px;"></i>
                                        <i class="fa-solid fa-star" style="background: linear-gradient(to bottom, #FFD700, #FFA500); -webkit-background-clip: text; color: transparent; font-size: 12px;"></i>
                                        <i class="fa-solid fa-star" style="background: linear-gradient(to bottom, #FFD700, #FFA500); -webkit-background-clip: text; color: transparent; font-size: 12px;"></i>
                                        <i class="fa-solid fa-star" style="background: linear-gradient(to bottom, #FFD700, #FFA500); -webkit-background-clip: text; color: transparent; font-size: 12px;"></i>
                                        <i class="fa-regular fa-star" style="background: linear-gradient(to bottom, #FFD700, #FFA500); -webkit-background-clip: text; color: transparent; font-size: 12px;"></i>
                                    </span>
                                    <p style="font-size: 0.85rem;">₱{{ number_format($products->product_price, 2) }}</p>
                                    <p class="card-text" style="font-size: 12px;"><span class="text-black">Seller:&nbsp</span>{{ $products->product_seller }}</p>
                                    <p class="card-text text-muted" style="font-size: 0.8rem;" hidden>{{ Str::limit($products->product_description, 50) }}</p>
                                    <p class="card-text" style="font-size: 0.85rem; margin-bottom: -15px; margin-left: -8px"><span class="me-1 text-secondary"><i class="fa-solid fa-location-dot"></i> {{ $products->product_place }}</span></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="productModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()" style="position: absolute; top: 10px; right: 10px;"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" class="img-fluid product_image" alt="Product Image" style="max-height: 300px; object-fit: cover;">
                <hr>
                <div class="row d-flex align-items-center justify-content-between mb-0 mt-2">
                    <div class="col-auto mb-0 ms-4">
                        <p class="product_seller fw-bold mb-0">Product Seller</p>
                </div>
                    <div class="col-auto mb-0 me-4">
                        <p class="product_price mb-0">₱0.00</p>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <p class="mb-0">Quantity:</p>
                    <p class="product_quantity mb-0   ms-2" style="font-size: 14px" >Product Quantity</p>
                </div>
                    <p class="text-center mb-0" style="font-size: 14px">Description</p>
                    <p class="product_description form-control mb-0" style="font-size: 14px; font-style:italic">Product Description</p>
                    <div class="d-flex align-items-center mt-1">
                        <i class="fa-solid fa-location-dot me-1 text-secondary" style="font-size: 12px"></i>
                        <p class="product_place fw-light mb-0" style="font-size: 12px">Product Location</p>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="edit btn btn-sm btn-secondary"><i class="fa-regular fa-pen-to-square"></i></button>
                <form id="deleteProductForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>



<div id="editModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Update Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editProductId" name="id">
                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="product_name" required>
                    </div>
                    <div class="row  mb-3">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <label for="editProductSeller" class="form-label">Name of Seller/Company</label>
                        <input type="text" step="0.01" class="form-control" id="editProductSeller" name="product_seller" required>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="editProductPrice" name="product_price" required>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <label for="editProductQuantity" class="form-label">Quantity</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">−</button>
                            <input type="number" step="1" class="form-control text-center" id="editProductQuantity" name="product_quantity" required value="1" min="1">
                            <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    </div>

                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="product_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductPlace" class="form-label">Location</label>
                        <input type="text" class="form-control" id="editProductPlace" name="product_place">
                    </div>
                    <button type="submit" class="btn btn-dark">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleCard() {
        var card = document.getElementById("productCard");
        var newProductCol = document.getElementById("newProductCol");
        var productListCol = document.getElementById("productListCol");


        card.classList.toggle("d-none");

        // Adjust column widths based on card visibility
        if (card.classList.contains("d-none")) {
            newProductCol.classList.remove("col-md-5");
            productListCol.classList.remove("col-md-5");
            productListCol.classList.add("col-md-12");
        } else {
            newProductCol.classList.add("col-md-6");
            productListCol.classList.remove("col-md-12");
            productListCol.classList.add("col-md-6");
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Select all alert elements
        let alerts = document.querySelectorAll('.alert');
        
        // Loop through each alert
        alerts.forEach((alert) => {
            // Set a timeout to fade out the alert after 3 seconds (3000 ms)
            setTimeout(() => {
                alert.classList.add('fade'); // Add Bootstrap 'fade' class for transition
                alert.classList.add('show'); // Trigger the transition to make it disappear smoothly
                alert.style.opacity = '0'; // Set opacity to 0 to fade out
                
                // Remove the alert element from the DOM after it fades out
                setTimeout(() => {
                    alert.remove();
                }, 500); // Adjust delay to match transition duration
            }, 3000); // Duration before fade out begins
        });
    });

    document.querySelectorAll('.card-product').forEach(card => {
    card.addEventListener('click', () => {
        const productId = card.getAttribute('data-id');
        openProductModal(productId);
    });
});

function openProductModal(productId) {
    fetch(`/products/${productId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Populate modal fields with the fetched product data
            document.getElementById('productModalLabel').innerText = data.product_name;
            document.querySelector('.modal-body .product_image').src = `/storage/${data.product_image}`;
            document.querySelector('.modal-body .product_price').innerText = `₱${data.product_price ? Number(data.product_price).toFixed(2) : '0.00'}`;
            document.querySelector('.modal-body .product_seller').innerText = data.product_seller;
            document.querySelector('.modal-body .product_quantity').innerText = data.product_quantity;
            document.querySelector('.modal-body .product_description').innerText = data.product_description;
            document.querySelector('.modal-body .product_place').innerText = data.product_place;

            // Set the correct product ID for the edit button's click event
            document.querySelector('.edit').setAttribute('onclick', `openEditModal(${productId})`);

            // Set the action URL for the delete form with the correct productId
            const deleteForm = document.getElementById('deleteProductForm');
            deleteForm.action = `/products/${productId}`; // Update the form action with the correct productId

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('productModal'));
            modal.show();
        })
        .catch(error => console.error('Error fetching product:', error));
}

// Delete product function
function deleteProduct(productId) {
    const confirmation = confirm('Are you sure you want to delete this product?');
    if (confirmation) {
        fetch(`/products/${productId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error deleting the product');
            }
            // Optionally, you can refresh the page or remove the deleted product from the DOM
            window.location.reload(); // Or remove the product from the list dynamically
        })
        .catch(error => console.error('Error deleting product:', error));
    }
}


    function closeModal() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
        modal.hide();
    }


    function openEditModal(productId) {
        fetch(`/products/${productId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched data:', data);  // Ensure data is correct in console

                // Set form field values with fetched data
                document.getElementById('editProductId').value = productId;
                document.getElementById('editProductName').value = data.product_name || 'No Name';
                document.getElementById('editProductQuantity').value = data.product_quantity || 'No quantity';
                document.getElementById('editProductSeller').value = data.product_seller || 'No seller';
                document.getElementById('editProductPrice').value = data.product_price || '0.00';
                document.getElementById('editProductDescription').value = data.product_description || 'No Description';
                document.getElementById('editProductPlace').value = data.product_place || 'No Location';

                // Update form action with the correct product ID
                const form = document.getElementById('editProductForm');
                form.action = `/products/${productId}`;  // Update form action dynamically


                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal'));
                modal.hide(); 
                setTimeout(() => {
                    modal.show();
                }, 100);
            })
            .catch(error => console.error('Error fetching product:', error));
    }

    function increaseQuantity() {
        const quantityInput = document.getElementById("editProductQuantity");
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById("editProductQuantity");
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {  // Prevent going below 1
            quantityInput.value = currentValue - 1;
        }
    }


</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>