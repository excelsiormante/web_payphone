 <div id="confirmationModal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">Please confirm purchase:</h2>
        		<h3 class="text-center" id="plan_name"></h3>
        		<p class="text-center" id="plan_price"></p>
                <div class="row">
                    <div class="text-center">
            		<button class="btn btn-success btn-lg" data-dismiss="modal" onclick="subscribePlan()" aria-hidden="true">Confirm</button>
            		<button class="btn btn-danger btn-lg" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                </div>
        	</div>
        </div>
        </div>
     <input type="hidden" id="hid_id"/>
     <input type="hidden" id="hid_duration"/>
     <input type="hidden" id="hid_price"/>
    </div>


 <div id="pinvoucherModal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center">Enter Voucher Pin:</h2>
                <input style="text-align:center; width: 300px;  margin-left: auto; margin-right: auto;" class="form-control" name="amount"  placeholder="Voucher Pin" id="amount">
                <br>
                <div class="row">
                    <div class="text-center">
                    <button class="btn btn-success btn-lg" data-dismiss="modal" aria-hidden="true">Submit</button>
                    <button class="btn btn-danger btn-lg" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>