<div id="company-overview-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <div class="row">
            <div id="errors"></div>
            <form class="col s12" method="post" action="#" id="company-overview-update-form">
                @csrf
                <input type="hidden" name="company_overview_id" value="{{$business_profile->companyOverview->id}}">
                <div class="row">
                    @foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
                        <div class="input-field col s6">
                            <label for="{{$company_overview->name}}">{{str_replace('_', ' ', ucfirst($company_overview->name))}}</label>
                            <input id="{{$company_overview->name}}" type="text" class="validate" name="name[{{$company_overview->name}}]" value="{{$company_overview->value}}">
                        </div>
                    @endforeach
                </div>
                
                <div class="center-align submit_btn_wrap">
                    <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
    </div>
</div>