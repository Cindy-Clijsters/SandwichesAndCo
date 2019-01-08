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
                        <div>Categorieën</div>
                    </h1>
                    
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ title }}</h4>
                                    </div>
                                    
                                    <div class="card-body">
                                        {% if successMessage is not empty %}
                                            <div class="alert alert-success">{{ successMessage }}</div>
                                        {% endif %}
                                        
                                        <form action="" method="post" novalidate>
                                            
                                            <div class="form-group">
                                                <label for="name">Naam <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.name is defined %}is-invalid{% endif %}" id="name" name="name" value="{{ tmpProductCategory.name }}" autofocus tabindex="1">
                                                {% if errors.name is defined %}
                                                    <div class="invalid-feedback">{{ errors.name }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="status">Status <i class="ion ion-android-star"></i></label>
                                                <select class="form-control {% if errors.status is defined %}is-invalid{% endif %}" id="status" name="status" tabindex="2">
                                                    <option value=""></option>
                                                    {% for statusOption in productCategoryStatuses %}
                                                        <option value="{{ statusOption }}" {% if (tmpProductCategory.status == statusOption) %} selected {% endif %}>
                                                            {{ translateProductCategoryStatus(statusOption) }}
                                                        </option>
                                                    {% endfor %}
                                                </select>
                                                {% if errors.status is defined %}
                                                    <div class="invalid-feedback">{{ errors.status }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <button ctype="submit" class="btn btn-sm btn-primary mt-2" tabindex="3">{{ buttonText }}</button>
                                                <a href="productCategory.php" class="btn btn-sm btn-outline-primary mt-2" tabindex="4">Annuleren</a>
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