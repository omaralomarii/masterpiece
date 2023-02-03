{{-- {{ dd($cart) }} --}}
@extends('Master')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p></p>
                        <h1>Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $c)
                                    @php
                                        $p = App\Models\Product::find($c['product_id']);
                                    @endphp
                                    <tr class="table-body-row" id="re-{{ $c['id'] }}">
                                        <td class="product-remove" onclick="remove('re-{{ $c['id'] }}')"><a
                                                href="#"><i class="far fa-window-close"></i></a>
                                        </td>
                                        <td class="product-image"><img src="{{ $p['image'] }}" alt=""></td>
                                        <td class="product-name">{{ $p['name'] }}</td>
                                        <td class="product-price">{{ $p['price'] }}</td>
                                        <td class="product-quantity"><input type="number" placeholder="0"
                                                value="{{ $c['quantity'] }}"
                                                onchange="updateQ('{{ $c['id'] }}',{{ $p['price'] }})">
                                        </td>
                                        <td class="product-total" id="{{ $c['id'] }}">
                                            {{ $p['price'] * $c['quantity'] }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Subtotal: </strong></td>
                                    @php
                                        $sum = 0;
                                        foreach ($cart as $cc) {
                                            $sum += $cc['price'] * $cc['quantity'];
                                        }
                                    @endphp
                                    <td>JD {{ $sum }}</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Shipping: </strong></td>
                                    <td>JD 50</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>JD {{ $sum + 50 }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            {{-- {{ dd($cart) }} --}}
                            <a href="/checkout" class="boxed-btn black">Check Out</a>
                        </div>
                    </div>

                    <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form action="index.html">
                                <p><input type="text" placeholder="Coupon"></p>
                                <p><input type="submit" value="Apply"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function remove(id) {
            const arr = id.split('-')
            const row = document.getElementById(id).remove();
            fetch(`/delete/${arr[1]}`).then(res => console.log(res.text()))
            console.log(row);
        }

        function updateQ(id, price) {
            const updateInput = document.getElementById(id);
            // console.log((event.target.value) * price);
            updateInput.textContent = (event.target.value) * price;
            fetch(`/update-cart/${id}/${event.target.value}`).then(res => console.log(res.text()))
        }
    </script>
    <!-- end cart -->
@endsection
