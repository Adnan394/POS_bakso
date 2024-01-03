@extends('layouts.admin')

@section('content')
    <div style="overflow-y: hidden" class="page-wrapper">
        <div class="container-fluid pt-3" style="height: 100vh">
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 py-3">
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#home-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Makanan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#profile-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Minuman</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div data-spy="scroll" class="col" style="position: relative; height: 570px;">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="home-b1">
                                <div class="row justify-content-end">
                                <div class="col-4 mb-4">
                                    <div class="card">
                                      <a href="#">
                                        <img
                                          class="card-img-top img-fluid mx-auto d-block"
                                          src="{{ asset('assets/images/bakso-icon.png') }}"
                                          alt="Chicken Burger"
                                        />
                                        <span class="border-top"></span>
                                        <div class="card-body border-top py-2 text-center">
                                          <h6 class="mb-0">Chicken Burger</h6>
                                          <p class="card-text">Rp. 27.000</p>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                <div class="col-4 mb-4">
                                    <div class="card">
                                      <a href="#">
                                        <img
                                          class="card-img-top img-fluid mx-auto d-block"
                                          src="{{ asset('assets/images/bakso-icon.png') }}"
                                          alt="Chicken Burger"
                                        />
                                        <span class="border-top"></span>
                                        <div class="card-body border-top py-2 text-center">
                                          <h6 class="mb-0">Chicken Burger</h6>
                                          <p class="card-text">Rp. 27.000</p>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                <div class="col-4 mb-4">
                                    <div class="card">
                                      <a href="#">
                                        <img
                                          class="card-img-top img-fluid mx-auto d-block"
                                          src="{{ asset('assets/images/bakso-icon.png') }}"
                                          alt="Chicken Burger"
                                        />
                                        <span class="border-top"></span>
                                        <div class="card-body border-top py-2 text-center">
                                          <h6 class="mb-0">Chicken Burger</h6>
                                          <p class="card-text">Rp. 27.000</p>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-b1">
                                <div class="row justify-content-end">
                                <div class="col-4 mb-4">
                                    <div class="card">
                                      <a href="#">
                                        <img
                                          class="card-img-top img-fluid mx-auto d-block"
                                          src="{{ asset('assets/images/bakso-icon.png') }}"
                                          alt="Chicken Burger"
                                        />
                                        <span class="border-top"></span>
                                        <div class="card-body border-top py-2 text-center">
                                          <h6 class="mb-0">Chicken Burger</h6>
                                          <p class="card-text">Rp. 27.000</p>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="card">
                                      <a href="#">
                                        <img
                                          class="card-img-top img-fluid mx-auto d-block"
                                          src="{{ asset('assets/images/bakso-icon.png') }}"
                                          alt="Chicken Burger"
                                        />
                                        <span class="border-top"></span>
                                        <div class="card-body border-top py-2 text-center">
                                          <h6 class="mb-0">Chicken Burger</h6>
                                          <p class="card-text">Rp. 27.000</p>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                  <div class="col-4 mb-4">
                                    <div class="card">
                                      <a href="#">
                                        <img
                                          class="card-img-top img-fluid mx-auto d-block"
                                          src="{{ asset('assets/images/bakso-icon.png') }}"
                                          alt="Chicken Burger"
                                        />
                                        <span class="border-top"></span>
                                        <div class="card-body border-top py-2 text-center">
                                          <h6 class="mb-0">Chicken Burger</h6>
                                          <p class="card-text">Rp. 27.000</p>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <h4>Cart</h4>
                    <hr />
                    <div data-spy="scroll" class="row" style="position: relative; height: 460px; overflow: auto">
                        <div class="col-12 mb-2">
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-6">Chicken Burger</div>
                                        <div class="col-6">Rp. 27.000</div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off" checked />
                                                    Cheese
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" id="option2"
                                                        autocomplete="off" />
                                                    Sauces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        -
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[1]"
                                                    class="form-control input-number col-2" value="1" min="1"
                                                    max="10" readonly />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        +
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-6">Chicken Burger</div>
                                        <div class="col-6">Rp. 27.000</div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off" checked />
                                                    Cheese
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" id="option2"
                                                        autocomplete="off" />
                                                    Sauces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        -
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[1]"
                                                    class="form-control input-number col-2" value="1" min="1"
                                                    max="10" readonly />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        +
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-6">Chicken Burger</div>
                                        <div class="col-6">Rp. 27.000</div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off" checked />
                                                    Cheese
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" id="option2"
                                                        autocomplete="off" />
                                                    Sauces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        -
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[1]"
                                                    class="form-control input-number col-2" value="1" min="1"
                                                    max="10" readonly />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        +
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-6">Chicken Burger</div>
                                        <div class="col-6">Rp. 27.000</div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off" checked />
                                                    Cheese
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" id="option2"
                                                        autocomplete="off" />
                                                    Sauces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        -
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[1]"
                                                    class="form-control input-number col-2" value="1" min="1"
                                                    max="10" readonly />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        +
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="row justify-content-between mb-2">
                                        <div class="col-6">Chicken Burger</div>
                                        <div class="col-6">Rp. 27.000</div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off" checked />
                                                    Cheese
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" id="option2"
                                                        autocomplete="off" />
                                                    Sauces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        -
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[1]"
                                                    class="form-control input-number col-2" value="1" min="1"
                                                    max="10" readonly />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        +
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-6">
                            <div class="pt-1 px-4">
                                <h6>Item Total</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-1 px-4 text-right">
                                <h6>8 Items</h6>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-6">
                            <div class="pt-1 px-4">
                                <h6>Price Total</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-1 px-4 text-right">
                                <h6>Rp. 120.000</h6>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-lg btn-warning btn-block" data-toggle="modal"
                                data-target="#confirmOrderCenter">
                                Pay Rp. 108.000
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="confirmOrderCenter" tabindex="-1" role="dialog"
            aria-labelledby="confirmOrderCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Confirm Your Order
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure your order has correct?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
    </div>
@endsection
