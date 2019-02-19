<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} : {{ title }}</title>
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
                                        <h4>{{ title }}</h4>
                                    </div>
                                    
                                    <div class="card-body">
                                        
                                        <form action="" method="post" novalidate>
                                            
                                            <div class="form-group">
                                                <label for="category">Product categorie <i class="ion ion-android-star"></i></label>
                                                <select class="form-control {% if errors.productCategory is defined %}is-invalid{% endif %}" id="productCategory" name="productCategory" autofocus tabindex="1">
                                                    <option value=""></option>
                                                    {% for productCategory in productCategories %}
                                                        <option value="{{ productCategory.id}}" {% if (tmpProduct.productCategory == productCategory.id) %} selected {% endif %}>
                                                            {{ productCategory.name }}
                                                        </option>
                                                    {% endfor %}
                                                </select>
                                                {% if errors.productCategory is defined %}
                                                    <div class="invalid-feedback">{{ errors.productCategory }}</div>
                                                {% endif %}                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name">Naam <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.name is defined %}is-invalid{% endif %}" id="name" name="name" value="{{ tmpProduct.name }}"  tabindex="2">
                                                {% if errors.name is defined %}
                                                    <div class="invalid-feedback">{{ errors.name }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="price">Prijs <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.price is defined %}is-invalid{% endif %}" id="price" name="price" value="{{ tmpProduct.price }}" tabindex="3">
                                                {% if errors.price is defined %}
                                                    <div class="invalid-feedback">{{ errors.price }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Toppings <i class="ion ion-android-star"></i></label>
                                                
                                                <div>
                                                    {% for toppingOption in toppings %}
                                                       <span class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="topping[]" id="topping-{{ toppingOption.id }}" value="{{ toppingOption.id }}" tabindex="4" class="{% if errors.toppings is defined %}is-invalid{% endif %}" {% if toppingOption.id in tmpProduct.toppings %} checked {% endif %} >
                                                            <label for="topping-{{ toppingOption.id }}">{{ toppingOption.name }}</label>
                                                        </span>
                                                    {% endfor %}
                                                </div>
                                                    
                                                {% if errors.toppings is defined %}
                                                <div> <!--class="invalid-feedback" -->{{ errors.toppings }}</div>
                                                {% endif %}

                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="status">Status <i class="ion ion-android-star"></i></label>
                                                <select class="form-control {% if errors.status is defined %}is-invalid{% endif %}" id="status" name="status" tabindex="5">
                                                    <option value=""></option>
                                                    {% for statusOption in productStatuses %}
                                                        <option value="{{ statusOption }}" {% if (tmpProduct.status == statusOption) %} selected {% endif %}>
                                                            {{ translateProductStatus(statusOption) }}
                                                        </option>    
                                                    {% endfor %}
                                                </select>
                                                {% if errors.status is defined %}
                                                    <div class="invalid-feedback">{{ errors.status }}</div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <button ctype="submit" class="btn btn-sm btn-primary mt-2" tabindex="6">{{ buttonText }}</button>
                                                <a href="product.php" class="btn btn-sm btn-outline-primary mt-2" tabindex="7">Annuleren</a>
                                            </div>
                                            
                                        </form>
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