@if($flag==0)
<div class="card-alert card orange store-update-warning">
    <div class="card-content white-text">
        <p>WARNING : Please update your store profile from <a href="#store-config-modal-block" class="modal-trigger">here</a>. This will make ensure your trust and buyer will find you easily. Shop Merchantbay system will use your store information to some filtration</p>
    </div>
</div>
@endif
<div class="col m12 card user-profile-basic-info-block">

    <div class="row profile-block store-config-block">
        <div class="col m12">
            <legend style="margin-bottom: 20px;">Profile Information</legend>
        </div>
        <div class="col m3 profile-image-block">
            <img src="{{ asset('storage/'.$user->image) }}" id="profile_image" alt="avatar" width="300px">
            <div class="change_photo">
                <form method="post" id="upload-image-form" enctype="multipart/form-data">
                    @csrf
                    <a href="javascript:void(0)" class="btn profile-image-upload-trigger waves-effect waves-light green">
                        <i class="material-icons">create</i> Change Photo
                    </a>
                    <div class="form-group" style="display: none;">
                        <input type="file" name="image" class="form-control profile-image-upload-trigger-alias" id="image-input">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <button type="submit" class="btn waves-effect waves-light green">Upload</button>
                </form>
            </div>
        </div>
        <div class="col m9 profile-info-block">
            <div class="user-profile-info-block">
                <p><i class="material-icons dp48 waves-effect waves-light">person</i> {{$user->name}}</p>
                <p><i class="material-icons dp48 waves-effect waves-light">email</i> {{$user->email}}</p>
                <p><i class="material-icons dp48 waves-effect waves-light">local_phone</i> {{$user->phone}}</p>
            </div>
            @if(count($businessProfiles) > 0)
            @php
                $className = '';
                if(count($businessProfiles)==3) {
                    $className = "col m4";
                } elseif(count($businessProfiles)==2) {
                    $className = "col m6";
                } else {
                    $className = "col m12";
                }
            @endphp
            <div class="row profile-block business-profile-block">
                <div class="col m12">
                    <legend>My Businesses</legend>
                </div>
                <div class="col m12">
                    @foreach($businessProfiles as $key=>$businessprofile)
                    <div class="card user-business-profile-short-info <?php echo $className; ?>">
                        <p><span style="font-weight: 500;">Business Name:</span> <a href="{{route('business.profile.show',$businessprofile->id)}}">{{ $businessprofile->business_name }}</a></p>
                        <p><span style="font-weight: 500;">Business Location:</span> {{ $businessprofile->location }}</p>
                        <p><span style="font-weight: 500;">Business Type:</span> @php echo ($businessprofile->business_type==1 ? 'Manufacturer':'Wholesaler') @endphp</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    <div>
        <a href="{{route('myorder')}}">My Orders</a>
    </div>



</div>

@include('user.profile.user_info._scripts')
