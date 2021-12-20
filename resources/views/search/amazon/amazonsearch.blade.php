@extends('layouts.admin')
@section('main-content')
    <div class="row">
        <div class="col-lg-12 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Search in amazon </h6>
                </div>

                <div class="card-body">

                    <form method="POST"  autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">search</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Keyword <span class="small text-danger">*</span></label>
                                        <input type="text" id="search_term" class="form-control" name="search_term" placeholder="search term" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="amazon_domain">Amazon Domain</label>
                                        <select class="form-control form-control-user" id="amazon_domain" name="amazon_domain">
                                            <option value="amazon.com">amazon.com</option>
                                            <option value="amazon.de">amazon.de</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="category_id">category id</label>
                                        <input type="text" id="category_id" class="form-control" name="category_id"  value="">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="sort_by">sort by</label>
                                        <select type="text" id="sort_by" class="form-control" name="sort_by" >
                                            <option value="price_low_to_high">price low to high</option>
                                            <option value="price_high_to_low">price high to low</option>
                                            <option value="featured">featured </option>
                                            <option value="average_review">average review</option>
                                            <option value="most_recent">most recent</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="button" name="search" id="search" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
    <div class="row">
        <div id="loading" hidden>
            <i class="fas fa-spinner fa-spin fa-5x"></i>
        </div>
        <div id="result_table" class="col-lg-12 order-lg-1" hidden>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="table-responsive pakainfo">
                        <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary">Result </h2>
                        </div>
                        <table class="pakainfo table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>asin</th>
                                <th>categories</th>
                                <th>image</th>
                                <th>bestseller</th>
                                <th>position</th>
                                <th>rating</th>
                                <th>ratings_total</th>
                                <th>price</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
    $(document).ready(function(){


        function fetch_customer_data(data)
        {
            $("#loading").attr('hidden', false);
            $.ajax({

                url:"{{ route('amazon.searchbyterm') }}",
                method:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {"amazon_domain":data['amazon_domain'],"category_id":data['category_id'],"search_term":data["search_term"],"sort_by":data['sort_by']},
                dataType:'json',
                success:function(res)
                {
                    $('tbody').html(res.data);
                    $("#loading").attr('hidden', true);
                    $("#result_table").attr('hidden', false);
                }
            })
        }

        $(document).on('click', '#search', function(){

            if($('#search_term').val()==="")
            {      alert("Search term entry!");
            }
            else
            {
                const data=[];
                data['amazon_domain']=$('#amazon_domain').val();
                data['search_term']=$('#search_term').val();
                data['category_id']=$('#category_id').val();
                data['sort_by']=$('#sort_by').val();
                fetch_customer_data(data);
            }

        });
    });
    </script>
@endsection
