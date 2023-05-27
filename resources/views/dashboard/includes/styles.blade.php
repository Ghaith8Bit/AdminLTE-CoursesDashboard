<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<style>
    #chat-card::-webkit-scrollbar {
        width: 12px;
    }

    #chat-card::-webkit-scrollbar-thumb {
        background-color: #222;
        border-radius: 20px;
    }

    .form-check-label {
        border-radius: 50px;
        background-color: #ddd;
        transition: background-color 0.2s;
        width: 60px;
        height: 30px;
        cursor: pointer;
        display: inline-block;
        position: relative;
    }

    .form-check-input:checked+.form-check-label {
        background-color: #007bff;
    }

    .form-check-input {
        display: none;
    }

    .form-check-label:after {
        content: "";
        background-color: white;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: transform 0.2s;
    }

    .form-check-input:checked+.form-check-label:after {
        transform: translateX(30px);
    }

    .info-box-icon-hover:hover {
        cursor: pointer;
        transform: scale(1.1);
        transition: all 0.2s ease-in-out;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        font-size: 2rem;
        color: #fff;
    }

    .carousel-control-prev {
        margin-left: -100px
    }

    .carousel-control-next {
        margin-right: -100px
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-image: none;
    }
</style>
