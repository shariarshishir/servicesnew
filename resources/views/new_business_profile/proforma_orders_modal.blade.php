<a href="javascript:void(0);" class="waves-effect waves-light btn_green po_accept_trigger">Accept</a>
<a href="javascript:void(0);" class="waves-effect waves-light btn_green po_reject_trigger">Reject</a>
<div class="invoice_top_button_wrap"></div>
<div class="invoice_page_header">
    <legend>
        <i class="fa fa-table fa-fw " aria-hidden="true"></i> Pro-Forma Invoice
    </legend>
</div>
<!-- widget grid -->
<section id="widget-grid" class="pro_porma_invoice">
    <!-- NEW WIDGET START -->
    <article class="">
        <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">
            <!-- widget content -->
            <div class="widget-body p-0">
                <div class="row buyerdata_info_top">
                    <div class="col m6 input-field" id="buyerdata">
                        <span><b>Mahmood Sakib </b></span><br>
                        <span>mahmood.sakib@sayem-group.com</span>
                    </div>
                    <div class="col m6 input-field">
                        <div class="form-group has-feedback">
                            <label style="margin-bottom: 0; left: 0;"><b>Beneficiary</b></label>
                            <span style="display: block">Merchantbay</span>
                        </div>
                    </div>
                </div>
                <div class="input-field has_feedback_wrap">
                    <div class="row">
                        <div class="col s6 m4 l2">
                            <div class="form-group input-field has-feedback">
                                <label>Pro-forma ID</label>
                                <p><span>908712</span></p>
                            </div>
                        </div>
                        <div class="col s6 m4 l2">
                            <div class="form-group input-field has-feedback">
                                <label>Pro-forma Date</label>
                                <span>2022-04-19</span>
                            </div>
                        </div>
                        <div class="col s6 m4 l2">
                            <div class="form-group input-field has-feedback">
                                <label>Payment Within</label>
                                <span>Within 15 Days</span>
                            </div>
                        </div>
                        <div class="col s6 m4 l2">
                            <div class="form-group input-field has-feedback">
                                <label>Payment term</label>
                                <span>LC</span>
                            </div>
                        </div>
                        <div class="col s6 m4 l2">
                            <div class="form-group input-field has-feedback">
                                <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                <label>Shipment Term</label>
                                <span>FCL</span>
                            </div>
                        </div>
                        <div class="col s6 m4 l2">
                            <div class="form-group input-field has-feedback">
                                <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                <label>Shipping Address</label>
                                <span> 160 ROBINSON ROAD #24-09 </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line_item_wrap buyer_shipping_details">
                    <legend>Shipping Details</legend>
                    <div class="shipping_details input-field row">
                        <div class="form-group has-feedback col s12">
                            <label><b>Forwarder name </b></label>
                            <span> XYZ logistics Limited </span>
                        </div>
                        <div class="form-group has-feedback col s12">
                            <label><b>Forwarder Address </b></label>
                            <span> 160 ROBINSON ROAD #24-09 </span>
                        </div>
                        <div class="form-group  has-feedback col s12">
                            <label><b>Payable party </b></label>
                            <span> Buyer </span>
                        </div>
                    </div>
                    <div class="shipping_details_table no_more_tables">
                        <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                            <thead class="cf">
                                <tr>
                                    <th>Shipping Method</th>
                                    <th>Shipment Type</th>
                                    <th>UOM</th>
                                    <th>Per UOM Price ($)</th>
                                    <th>QTY</th>
                                    <!-- <th style="width:15%;">Tax</th> -->
                                    <th>Total ($)</th>
                                </tr>
                            </thead>
                            <tbody id="shipping-details-table-body" class="input-field">
                                <tr>
                                    <td data-title="Shipping Method">
                                        <span>FCL</span>
                                    </td>
                                    <td data-title="Shipment Type">
                                        <span>Ocean</span>
                                    </td>
                                    <td data-title="UOM">
                                        <span>TON </span>
                                    </td>
                                    <td data-title="Per UOM Price ($)">
                                        <span>2</span>
                                    </td>
                                    <td data-title="QTY">
                                        <span>5</span>
                                    </td>
                                    <td data-title="Total ($)">
                                        <span>500</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line_item_wrap">
                    <legend>Line Items</legend>
                    <div class="col s12">
                        <div class="no_more_tables">
                            <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                <thead class="cf">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Item / Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Sub Total</th>
                                        <!-- <th style="width:15%;">Tax</th> -->
                                        <th>Total Price</th>
                                        <!-- <th style="width:5%; text-align:center;"></th> -->
                                    </tr>
                                </thead>
                                <tbody id="lineitems" class="input-field">
                                    <tr>
                                        <td data-title="Sl. No.">1</td>
                                        <td data-title="Item / Description">
                                            <span>Womens Long-Sleeve 100% Cotton Cable Crewneck Sweater</span>
                                        </td>
                                        <td data-title="Quantity">
                                            <span>10000</span>
                                        </td>
                                        <td data-title="Unit Price">
                                            <span>6.5</span>
                                        </td>
                                        <td data-title="Sub Total">
                                            <span>65000</span>
                                        </td>
                                        <td data-title="Total Price">
                                            <span>65000</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="right-align grand_total_title" style="padding-right: 20px"><b>Total Invoice Amount: </b></td>
                                        <td data-title="Total Invoice Amount:" colspan="2" id="total_price_amount"><b>65000<b></b></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="invoice_terms_conditions invoice_buyer_conditions">
                    <legend>Terms &amp; Conditions</legend>
                    <div class="terms_conditions_list">
                        <ul class="list-group terms-lists">
                            <li class="list-group-item">
                                <div class="input-group input-field">
                                    <label class="terms-label">
                                    <i class="material-icons"> check </i> <span>Terms of payment: By irrevocable BTB letter of credit at sight /60 days from the date of negotiation of documents. Payment will be made in us dollar drawn on Bangladesh Bank, Dhaka.</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group input-field">
                                    <label class="terms-label">
                                    <i class="material-icons"> check </i> <span>Production: Subject to receipt of L/C &amp; UD.</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group input-field">
                                    <label class="terms-label">
                                    <i class="material-icons"> check </i> <span>BBLC Open: BBLC should be opened before completion of delivery.</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-group terms-lists">
                        </ul>
                    </div>
                </div>
                <div class="invoice_advising_bank">
                    <legend>Advising Bank</legend>
                    <div class="row input-field">
                        <div class="col s6 m4 l3">
                            <div class="form-group has-feedback">
                                <label>Name of the bank</label> <br>
                                <span> UCBL </span>
                            </div>
                        </div>
                        <div class="col s6 m4 l3">
                            <div class="form-group has-feedback">
                                <label>Branch name</label><br>
                                <span>Uttara</span>
                            </div>
                        </div>
                        <div class="col s6 m4 l3">
                            <div class="form-group has-feedback">
                                <label>Address of the bank </label><br>
                                <span> Uttara Dhaka </span>
                            </div>
                        </div>
                        <div class="col s6 m4 l3">
                            <div class="form-group has-feedback">
                                <label>Swift code</label><br>
                                <span>shdsbfsdasz</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line_item_wrap buyer_signature">
                    <legend>Signature</legend>
                    <div class="row">
                        <div class="col s6 input-field">
                            <h6>Buyer Side</h6>
                            <div class="form-group has-feedback">
                                <span> Sakib </span>
                            </div>
                            <div class="form-group has-feedback">
                                <span>Director</span>
                            </div>
                        </div>
                        <div class="col s6 input-field">
                            <h6>Beneficiary Side</h6>
                            <div class="form-group has-feedback">
                                <span> Mizan </span>
                            </div>
                            <div class="form-group has-feedback">
                                <span> Merchandiser </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end widget content -->
        </div>
        <!-- end widget -->
    </article>
    <!-- WIDGET END -->
</section>
<!-- end widget grid -->