<div id="company-overview-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <legend>Company Overview</legend>
        <div class="row">
            <div id="errors"></div>
            <form class="col s12" method="post" action="#" id="company-overview-update-form">
                @csrf
                <input type="hidden" name="company_overview_id" value="{{$business_profile->companyOverview->id}}">
                <div class="row">
                    @foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
                        <div class="input-field col s12 m12 l6">
                            <label for="{{$company_overview->name}}">{{str_replace('_', ' ', ucfirst($company_overview->name))}}</label>
                            <input id="{{$company_overview->name}}" type="text" class="validate" name="name[{{$company_overview->name}}]" value="{{$company_overview->value}}">
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col s12 input-field">
                        <label for="address">Address</label>
                        <td>
                            <textarea class="address" name="address" value="{{$business_profile->companyOverview->address}}" type="text"  rows="20" cols="50">{{$business_profile->companyOverview->address ?? ''}}</textarea>
                        </td>
                    </div>
                </div>
                <div class="row ">
                    <div class="col s12 input-field">
                        <label for="address">Factory Address</label>
                        <td>
                            <textarea class="factory_address" name="factory_address" value="{{$business_profile->companyOverview->factory_address}}" type="text"  rows="20" cols="50">{{$business_profile->companyOverview->factory_address ?? ''}}</textarea>
                        </td>
                    </div>
                </div>
                <div class="row ">
                    <div class="col s12 input-field">
                        <label for="about_company">About company</label>
                        <td>
                            <textarea class="about-company" name="about_company" value="{{$business_profile->companyOverview->about_company}}" type="text" id="about-company-short-description" rows="20" cols="50">{{$business_profile->companyOverview->about_company ?? ''}}</textarea>
                        </td>
                    </div>
                </div>
                
                <div class="submit_btn_wrap">
                    <div class="row">
                        <div class="col s12 m6 l6 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
                        <div class="col s12 m6 l6 right-align">
                            <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">&nbsp;</a>
    </div> -->
</div>