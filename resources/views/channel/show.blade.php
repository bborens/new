@extends('layouts.app')

@section('content')

<section id="showcase" class="dash-header">

    <section id="showcase-inner" class="py-5 text-white">

            <div class="container">
              <div class="row text-center">
                <div class="col-md-12">
                  <h1 class="display-3">Chef Dashboard</h1>
                  <p class="lead">View all your saved and created recipes in one place!</p>
                </div>
              </div>

        </div>
          </section>

    </section>
    <section class="jumbotron-blue">
          <!-- Breadcrumb -->
          <section id="bc" class="mt-3">
            <div class="container">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">
                      <i class="fas fa-home"></i> Homepage </a>
                  </li>
                  <li class="breadcrumb-item"> Dashboard</li>
                </ol>
              </nav>
            </div>
          </section>

          <section id="dashboard" class="py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
            <section class="jumbotron-white">
                  <h2>Welcome Chef Bryan!</h2>
                  <p>Here are the community recipes you've saved!</p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date Saved</th>
                        <th scope="col">Recipe Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>10-5-18</td>
                        <td>Provolone Stuffed Mini Meatballs</td>
                        <td>
                          <a class="btn btn-light" href="#">View Recipe</a>
                        </td>
                      </tr>
                      <tr>
                        <td>10-8-18</td>
                        <td>Orange Thai Lettuce Wraps</td>
                        <td>
                          <a class="btn btn-light" href="#">View Recipe</a>
                        </td>
                      </tr>
                      <tr>
                        <td>9-2-18</td>
                        <td>Barbacoa Tacos</td>
                        <td>
                          <a class="btn btn-light" href="#">View Recipe</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </section>
    <br>
    <section id="dashboard" class="py-4">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="jumbotron-white">
                <h2>Your Cookbook!</h2>
                <p>Here are the recipes you've shared with the community!</p>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Date Saved</th>
                        <th scope="col">Recipe Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>10-8-18</td>
                        <td>Provolone Stuffed Mini Meatballs</td>
                        <td>
                        <a class="btn btn-light" href="{{ url('/recipe') }}">View Recipe</a>
                        </td>
                    </tr>
                    <tr>
                        <td>10-12-18</td>
                        <td>Orange Thai Lettuce Wraps</td>
                        <td>
                        <a class="btn btn-light" href="{{ url('/recipe') }}">View Recipe</a>
                        </td>
                    </tr>
                    <tr>
                        <td>9-7-18</td>
                        <td>Barbacoa Tacos</td>
                        <td>
                        <a class="btn btn-light" href="{{ url('/recipe') }}">View Recipe</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </section>
        <br>
        <section id="dashboard" class="py-4">
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                            <section class="jumbotron-white">

                    <h2>Your favorite Chefs!</h2>
                    <p>Your favorite saved chefs!</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Date Saved</th>
                            <th scope="col">Chef Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>10-8-18</td>
                            <td>Gordon Ramsey</td>
                            <td>
                            <a class="btn btn-light" href="{{ url('/recipe') }}">View Chef</a>
                            </td>
                        </tr>
                        <tr>
                            <td>10-12-18</td>
                            <td>29 Palms Bob</td>
                            <td>
                            <a class="btn btn-light" href="{{ url('/recipe') }}">View Chef</a>
                            </td>
                        </tr>
                        <tr>
                            <td>9-7-18</td>
                            <td>Maddie Borenstein</td>
                            <td>
                            <a class="btn btn-light" href="{{ url('/recipe') }}">View Chef</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </section>
        </section>


@endsection
