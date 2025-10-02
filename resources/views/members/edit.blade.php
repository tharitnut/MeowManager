@extends('home')
@section('css_before')
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">
<style>
  .img-container { max-height: 60vh; display:flex; align-items:center; justify-content:center; background:#f8f9fa; }
  .img-container img { max-width: 100%; }

      /* ========= Back Office Dark Minimal Theme (complete) ========= */
  :root{
    /* Base palette */
    --bg:#0b0f14; --card:#0f141a; --text:#e6e7eb; --muted:#98a2b3; --border:#1f2937;
    --shadow:0 10px 28px rgba(0,0,0,.35);
    --radius:16px;

    /* Accents */
    --accent:#60a5fa; --accent-ink:#0b1220;

    /* Buttons: distinct families */
    --logout-red:#b84b57;          /* Logout (top bar) base */
    --logout-rose:#cf7e92;          /* Logout hover */

    --danger-alt:#d05a6b;          /* Delete buttons (different red) */
    --danger-alt-hover:#e58593;

    /* Tables */
    --row-alt:#0d131a; --row-hover:#131a22;
  }

  body{ background:var(--bg); }

  /* Headings & cards */
  h1,h2,h3,h4,h5{ color:var(--text); font-weight:700; letter-spacing:.2px; }
  .mm-card{
    background:var(--card)!important; border:1px solid var(--border)!important;
    border-radius:var(--radius)!important; box-shadow:var(--shadow)!important;
  }

  /* ===== Tables ===== */
  .table{
    color:var(--text); background:var(--card); border-color:var(--border); box-shadow:var(--shadow);
    --bs-table-bg: transparent; --bs-table-color: var(--text);
    --bs-table-striped-bg: var(--row-alt); --bs-table-striped-color: var(--text);
    --bs-table-hover-bg: var(--row-hover); --bs-table-hover-color: var(--text);
    --bs-table-border-color: var(--border);
  }
  .table > :not(caption) > * > *{
    color:var(--text)!important; background:transparent; border-color:var(--border); vertical-align:middle;
  }
  .table thead tr.table-info th{
    background:#111823!important; color:var(--text)!important; border-color:var(--border)!important; font-weight:700;
  }
  .table thead th{ color:var(--text)!important; }
  .table-bordered{ border:1px solid var(--border); }
  .table-bordered > :not(caption) > *{ border-width:1px 0; }
  .table-bordered > :not(caption) > * > *{ border-width:0 1px; }
  .table-striped > tbody > tr:nth-of-type(odd) > *{ background:var(--row-alt)!important; }
  .table-hover > tbody > tr:hover > *{ background:var(--row-hover)!important; }
  .text-danger{ color:#ff8da1!important; }
  .table a{ color:#cdd5df; text-decoration:none; }
  .table a:hover{ color:#e6e7eb; text-decoration:underline; }

  /* ===== Forms ===== */
  label{ color:var(--text); font-weight:600; }
  .form-text,.form-hint,small{ color:var(--muted)!important; }
  .form-control,.form-select,.form-check-input{
    background:#0e1319; color:var(--text); border:1px solid var(--border); border-radius:12px;
  }
  .form-control::placeholder{ color:#8a97a6; }
  .form-control:focus,.form-select:focus{
    color:var(--text); background:#0e1319; border-color:#2b6cb0;
    box-shadow:0 0 0 .2rem rgba(96,165,250,.15);
  }
  .input-group-text{ background:#0e1319; color:var(--muted); border:1px solid var(--border); }
  .form-check-input:checked{ background-color:var(--accent); border-color:var(--accent); }
  .form-switch .form-check-input{ width:2.5em; height:1.25em; background-position:left center; }
  .form-switch .form-check-input:checked{ background-position:right center; }
  .invalid-feedback,.is-invalid ~ .invalid-feedback{ color:#ff8da1!important; }
  .is-invalid{ border-color:#f28497!important; }
  .form-control[type="file"]{ background:#0e1319; color:var(--text); border:1px solid var(--border); }

  /* ===== Buttons ===== */
  .btn{ border-radius:999px; font-weight:700; }
  .btn-primary{
    --bs-btn-color:var(--accent-ink); --bs-btn-bg:var(--accent); --bs-btn-border-color:var(--accent);
    --bs-btn-hover-bg:#7ab5ff; --bs-btn-hover-border-color:#7ab5ff;
    box-shadow:0 8px 22px rgba(96,165,250,.20);
  }
  .btn-outline-secondary{
    --bs-btn-color:#cdd5df; --bs-btn-border-color:var(--border);
    --bs-btn-hover-color:var(--text); --bs-btn-hover-bg:#0d131a; --bs-btn-hover-border-color:#334155;
  }

  /* Edit (warning) — improved contrast */
  .btn-warning{
    --bs-btn-bg:#f0b54a;           /* amber base */
    --bs-btn-border-color:#d89a33; /* outline */
    --bs-btn-color:#0b0f14;        /* dark label */
    --bs-btn-hover-bg:#f6c569;     /* hover */
    --bs-btn-hover-border-color:#e3ae4d;
    --bs-btn-active-bg:#e9b14d;
    --bs-btn-active-border-color:#d89a33;
    text-shadow:none;
    font-weight:800;
  }
  .btn-warning.btn-sm{ padding:.35rem .7rem; }

  /* Delete (danger) — raspberry, distinct from Logout */
  .btn-danger{
    --bs-btn-color:#ffffff;
    --bs-btn-bg:var(--danger-alt);
    --bs-btn-border-color:var(--danger-alt);
    --bs-btn-hover-bg:var(--danger-alt-hover);
    --bs-btn-hover-border-color:var(--danger-alt-hover);
    --bs-btn-active-bg:var(--danger-alt);
    --bs-btn-active-border-color:var(--danger-alt);
    box-shadow:0 6px 18px rgba(208,90,107,.18);
  }
  .btn-sm{ padding:.3rem .6rem; }

  input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1); /* Turns the black calendar icon white */
    cursor: pointer;
    }

  /* Topbar Logout button (separate class) */
  .btn-logout{
    background:var(--logout-red); color:#ffffff; border:1px solid var(--logout-red);
    border-radius:999px; padding:.5rem 1rem; font-weight:700; line-height:1;
    box-shadow:0 6px 18px rgba(184,75,87,.18);
    transition:background-color .15s ease,border-color .15s ease,transform .06s ease,box-shadow .15s ease;
  }
  .btn-logout:hover{
    background:var(--logout-rose); border-color:var(--logout-rose);
    box-shadow:0 8px 22px rgba(207,126,146,.22); transform:translateY(-1px);
  }
  .btn-logout:active{ transform:translateY(0); }
  .btn-logout:focus-visible{ outline:3px solid rgba(207,126,146,.35); box-shadow:0 0 0 3px rgba(207,126,146,.35); }

  /* ===== Pagination ===== */
  .pagination{ gap:.25rem; }
  .page-link{
    background:var(--card); color:var(--text);
    border:1px solid var(--border); border-radius:10px!important;
  }
  .page-link:hover{ background:var(--row-hover); color:var(--text); }
  .page-item.active .page-link{ background:var(--accent); color:var(--accent-ink); border-color:var(--accent); }
  .page-item.disabled .page-link{ color:var(--muted); background:#0d1218; border-color:var(--border); }

  /* Alerts */
  .alert{ border-radius:12px; border:1px solid var(--border); }
  .alert-info{ background:#0e1b24; color:#cfe7ff; border-color:#1b3a5b; }
  .alert-warning{ background:#221a0d; color:#ffe1a6; border-color:#3b2b0e; }
  .alert-danger{ background:#2a1518; color:#ffc0ca; border-color:#4b2026; }

  /* SweetAlert2 (theme-aligned) */
  .swal2-popup{ background:var(--card)!important; color:var(--text)!important; border:1px solid var(--border); }
  .swal2-confirm{ background:var(--danger-alt)!important; border-color:var(--danger-alt)!important; }
  .swal2-cancel{ background:#0d1218!important; color:var(--text)!important; border:1px solid var(--border)!important; }

  /* Small screens */
  @media (max-width:575.98px){
    .table{ font-size:.92rem; }
    .btn{ font-weight:600; }
  }
</style>
@endsection

@section('header')
@endsection
@section('sidebarMenu')
@endsection

@section('content')

<h3> Form Edit Member </h3>

<form action="/member/{{ $member->member_id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Username </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="username" required maxlength="50"
                value="{{ old('username', optional($member->user)->username) }}">
            @if(isset($errors))
            @if($errors->has('username')) <div class="text-danger">{{ $errors->first('username') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Password (change?) </label>
        <div class="col-sm-7">
            <input type="password" class="form-control" name="password" minlength="6" maxlength="50"
                placeholder="Leave blank to keep current">
            @if(isset($errors))
            @if($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div> @endif
            @endif
        </div>
    </div>

    <input type="hidden" name="role" value="Member">

    <div class="form-group row mb-2">
        <label class="col-sm-2"> First Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="first_name" required maxlength="50"
                value="{{ old('first_name', $member->first_name) }}">
            @if(isset($errors))
            @if($errors->has('first_name')) <div class="text-danger">{{ $errors->first('first_name') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Last Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="last_name" required maxlength="50"
                value="{{ old('last_name', $member->last_name) }}">
            @if(isset($errors))
            @if($errors->has('last_name')) <div class="text-danger">{{ $errors->first('last_name') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Telephone </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="telephone" required maxlength="10"
                value="{{ old('telephone', $member->telephone) }}">
            @if(isset($errors))
            @if($errors->has('telephone')) <div class="text-danger">{{ $errors->first('telephone') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Email </label>
        <div class="col-sm-7">
            <input type="email" class="form-control" name="email" required maxlength="50"
                value="{{ old('email', $member->email) }}">
            @if(isset($errors))
            @if($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Birth Date </label>
        <div class="col-sm-7">
            <input type="date" class="form-control" name="birth_date" required
                value="{{ old('birth_date', $member->birth_date) }}">
            @if(isset($errors))
            @if($errors->has('birth_date')) <div class="text-danger">{{ $errors->first('birth_date') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Register Date </label>
        <div class="col-sm-7">
            <input type="date" class="form-control" name="register_date" required
                value="{{ old('register_date', $member->register_date) }}">
            @if(isset($errors))
            @if($errors->has('register_date')) <div class="text-danger">{{ $errors->first('register_date') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Point </label>
        <div class="col-sm-7">
            <input type="number" class="form-control" name="point" min="0" value="{{ old('point', $member->point) }}">
            @if(isset($errors))
            @if($errors->has('point')) <div class="text-danger">{{ $errors->first('point') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Picture </label>
        <div class="col-sm-7">
            @if($member->member_pic)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$member->member_pic) }}" width="120">
            </div>
            @endif
            <input type="file" name="member_pic" accept="image/*"
                class="form-control"
                data-cropper-target="#member_pic_cropped_edit">
            <input type="hidden" name="member_pic_cropped" id="member_pic_cropped_edit">
            @if(isset($errors))
            @if($errors->has('member_pic'))
                <div class="text-danger">{{ $errors->first('member_pic') }}</div>
            @endif
            @endif
        </div>
    </div>


    <div class="form-group row mb-2">
        <label class="col-sm-2"> </label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/member" class="btn btn-danger">Cancel</a>
        </div>
    </div>

</form>

@endsection

@section('footer')
@endsection
@section('js_before')
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>

{{-- shared cropper modal (1:1) --}}
<div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Crop Image (1:1)</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="cropperImage" src="" alt="">
        </div>
        <small class="text-muted d-block mt-2">Use mouse wheel to zoom, drag to position.</small>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCrop" class="btn btn-success">Crop & Use</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  let cropper, currentHiddenInput;

  const cropperModalEl = document.getElementById('cropperModal');
  if (!cropperModalEl) return; // safety
  const cropperModal = new bootstrap.Modal(cropperModalEl, { keyboard:false });
  const cropperImg = document.getElementById('cropperImage');

  function attachCropperTo(input) {
    input.addEventListener('change', (e) => {
      const [file] = e.target.files || [];
      if (!file) return;

      const targetSelector = input.getAttribute('data-cropper-target');
      currentHiddenInput = document.querySelector(targetSelector);
      if (!currentHiddenInput) return;

      const reader = new FileReader();
      reader.onload = () => {
        cropperImg.src = reader.result;
        cropperModal.show();
        cropperImg.onload = () => {
          if (cropper) cropper.destroy();
          cropper = new Cropper(cropperImg, {
            aspectRatio: 1,
            viewMode: 1,
            background: false,
            autoCropArea: 1,
            dragMode: 'move',
            responsive: true,
          });
        };
      };
      reader.readAsDataURL(file);
    });
  }

  // Bind all file inputs that declare a target
  document.querySelectorAll('input[type="file"][data-cropper-target]').forEach(attachCropperTo);

  document.getElementById('btnCrop').addEventListener('click', () => {
    if (!cropper || !currentHiddenInput) return;
    const canvas = cropper.getCroppedCanvas({ width: 600, height: 600 });
    currentHiddenInput.value = canvas.toDataURL('image/jpeg', 0.9);
    cropperModal.hide();
  });
})();
</script>
@endsection

{{-- devbanban.com --}}