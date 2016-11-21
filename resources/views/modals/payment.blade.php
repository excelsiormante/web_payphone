 <div id="paymentModal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">Enter amount to be loaded:</h2>

        		<input style="text-align:center; width: 300px;  margin-left: auto; margin-right: auto;" type="number" class="form-control" name="amount"  placeholder="Amount in dollars ($)" id="amount" min="0" step="0.01">

                <br>

        		<p class="text-center">
        		    Pay Via:
        		</p>
                <div class="row">
                    <div class="col-md-2"></div>

                    <a href="{{url('paypal/set')}}"  aria-hidden="true" id="btnpaypal">
                        <div class="col-md-4 btnpayment" style="padding-left: 0px;  padding-right: 0px; height:50px; width:150px;">
                            <img src="{{asset('images/paypal.png')}}" class="img-responsive">
                        </div>
                    </a>

                    <div class="col-md-1"></div>

                    <a href="#" aria-hidden="true" id="btnpaymaya">
                        <div class="col-md-5 btnpayment" style="padding-left: 0px;  padding-right: 0px; height:200px; width:200px;">
                            <img src="{{asset('images/paymaya.png')}}" class="img-responsive">
                        </div>
                    </a>
                </div>

                <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Cancel</button>

        	</div>
        </div>
        </div>
    </div>


