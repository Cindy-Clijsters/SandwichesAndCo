<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Producten</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <meta name="description" content="{{ companyName }}" />
    <meta name="keywords" content="{{ companyName }}, sandwiches, take away" />
    <meta name="author" content="Cindy Clijsters" />

    {{ include('includes/stylesheet.php') }}
    
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            
            {{ include('includes/header.php') }}
            {{ include('includes/menuSideBar.php') }}
            
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div>Producten</div>
                    </h1>
                    
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Producten</h4>
                                    </div>
                                    <div class="card-body">
                                        {% if products is empty %}
                                        
                                            <p>Er zijn nog geen producten toegevoegd.</p>
                                        
                                        {% else %}
                                        
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Status</th>
                                                            <th>Opties</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {% for product in products %}
                                                            <tr>
                                                                <td>{{ product.name }}</td>
                                                                <td>
                                                                    <div class="badge {% if product.status == 'active' %} badge-success {% else %} badge-danger {% endif %} ">
                                                                        {{ translateProductStatus(product.status) }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="productDetail.php?id={{ product.id }}" class="btn btn-action btn-secondary">Bekijken</i></a>
                                                                    <a href="productUpdate.php?id={{ product.id }}" class="btn btn-action btn-secondary">Wijzigen</i></a>
                                                                    <a href="productDelete.php?id={{ product.id }}" class="btn btn-action btn-secondary">Verwijderen</i></a>
                                                                </td>
                                                            </tr>
                                                        {% endfor %}
                                                    </tbody>
                                                </table>
                                            </div>
                                        
                                        {% endif %}
                                        
                                        <a href="productCreate.php" class="btn btn-action btn-primary mt-2" tabindex="1">Een nieuw product toevoegen</i></a>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>

            {{ include('includes/footer.php') }}
            
        </div>
    </div>

    {{ include('includes/scripts.php') }}

</body>
</html>