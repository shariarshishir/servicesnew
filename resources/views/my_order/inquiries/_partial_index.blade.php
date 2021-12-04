<table>
    <thead>
      <tr>
        <th> ID</th>
        <th> Invoice Id</th>
        <th> Date</th>
        <th> Total Price</th>
        <th> Payment Within</th>
        <th> Proforma Type</th>
        <th> Status</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($proforma as $index => $po )
            @php $total_price_wt = 0; @endphp
            @foreach($po->performa_items as $item)
                @php $total_price_wt += $item->tax_total_price; @endphp
            @endforeach
            <tr>
                <td>{{$po->id}}</td>
                <td>{{ $po->proforma_id }}<br>
                    @if($po->status == 1)
                        PO ID: {{$po->po_no}}
                    @endif
                </td>
                <td>{{ $po->proforma_date }}</td>
                <td><a href="javascript:void(0)" data-toggle="modal" data-target="#detailsFormModal{{ $index }}">{{ number_format($total_price_wt,2) }}</a></td>
                <td>{{ $po->payment_within }}</td>
                <td>{{ $po->proforma_type}}</td>
                <td>
                    @if($po->status == 0)
                        <div class="status-btn">
                            <a href="/open-proforma-single-html/{{ $po->id }}" class="btn btn-warning" style="color: #fff; width: 120px;">
                                PI Pending<br />
                                <i class="fa fa-eye" aria-hidden="true"></i> &nbsp; View Invoice
                            </a>
                        </div>
                    @endif
                    @if($po->status == 1)
                        <div class="status-btn">
                            <a href="/open-proforma-single/{{ $po->id }}" class="btn btn-success" target="_blank" style="color: #fff; width: 120px;">
                                PO Generated<br />
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; View Pdf
                            </a>
                        </div>
                    @endif
                    @if($po->status == -1)
                        <div class="status-btn">
                            <a href="/open-proforma-single/{{ $po->id }}" class="btn btn-danger" target="_blank" style="color: #fff; width: 120px;">
                                PI Rejected<br />
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; View Pdf
                            </a>
                            <div class="revice_order_btn" style="display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;background-color: transparent;border: 1px solid #dae0e5;border-radius: 4px;color: #212529;">
                                <div class="update-po-btn">
                                    <a href="{{ action('PoController@edit', ['toid' => $po->buyer->id, 'poid' => $po->id]) }}" style="color: #0095ff; width: auto; padding: 0px !important; text-decoration: underline;">
                                        Update PO
                                    </a>
                                </div>
                                <div class="rejectdetails-po-btn">
                                    <a href="javascript:void(0);" style="color: #0095ff; width: auto; padding: 0px !important; text-decoration: underline;" data-toggle="modal" data-target="#rejectPoDetailsModal">
                                        PO rejection Causes
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="rejectPoDetailsModal" tabindex="-1" role="dialog" aria-labelledby="rejectPoDetailsModal"  aria-hidden="true" style="text-align: left;">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header modal-hdr-custum" style="background: rgb(85, 168, 96) none repeat scroll 0% 0%; border-radius: 4px 4px 0px 0px;">
                                        <h4 class="modal-title" style="color: #fff; font-size: 22px; font-weight: bold;">
                                            Why your PO have been rejected.
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 34px;color: #FFF;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body modal-bdy-bdr">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-bottom: 35px;">
                                                {{ $po->reject_message }}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

@include('my_order.inquiries._scripts')
