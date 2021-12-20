@extends('layouts.admin')

@section('main-content')
    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h3> rate in amazon</h3>
                                <p>Updated : {{date(now())}}</p>
                            </div>
                        </div>
                    </div>
<hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-profile-stats">
                                <span class="heading">22</span>
                                <span class="description">Keyword1</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-profile-stats">
                                <span class="heading">10</span>
                                <span class="description">Keyword2</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-profile-stats">
                                <span class="heading">89</span>
                                <span class="description">Keyword3</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-profile-stats">
                                <span class="heading">89</span>
                                <span class="description">Keyword3</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col text-center">
                            <hr>
                            <button type="button" class="btn btn-success">Update Rate</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Products</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('products.add') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Products information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Product Asin</label>
                                        <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Product Asin" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Description<span class="small text-danger">*</span></label>
                                        <textarea type="text" id="email" class="form-control" name="email"  value="">
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">KeyWord 1</label>
                                        <input type="text" id="key1" class="form-control" name="key1" placeholder="KeyWord 1">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Keyword 2</label>
                                        <input type="text" id="key2" class="form-control" name="key2" placeholder="KeyWord 2">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Keyword 3</label>
                                        <input type="text" id="key2" class="form-control" name="key2" placeholder="KeyWord 3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
