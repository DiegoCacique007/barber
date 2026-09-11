@extends('layouts.administrador')

@section('title', 'Nuevo horario')

@push('styles')
    <style>
        .horario-page-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:25px}
        .btn-volver{min-height:40px;display:inline-flex;align-items:center;justify-content:center;padding:0 15px;border:1px solid rgba(255,255,255,.15);border-radius:9px;background:#1a1a1a;color:#bbb;font-size:11px;text-decoration:none;transition:.2s}
        .btn-volver:hover{border-color:rgba(213,173,85,.25);color:#fff}

        .horario-form-card{width:100%;padding:32px;border:1px solid rgba(255,255,255,.10);border-radius:18px;background:#1a1a1a;box-shadow:0 15px 35px rgba(0,0,0,.12)}
        .horario-form-content{display:grid;grid-template-columns:1fr 1fr;gap:24px}
        .form-section{padding:24px;border:1px solid rgba(255,255,255,.08);border-radius:16px;background:#171717}

        .form-section-header{display:flex;align-items:center;gap:13px;margin-bottom:24px;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,.07)}
        .section-icon{width:42px;height:42px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(213,173,85,.18);border-radius:11px;background:rgba(213,173,85,.07);color:#ddb65a;font-size:16px}
        .form-section-header h5{margin:0;color:#fff;font-size:15px;font-weight:700}
        .form-section-header p{margin:4px 0 0;color:#999;font-size:11px}

        .form-fields{display:flex;flex-direction:column;gap:20px}
        .form-group-custom label{display:block;margin-bottom:8px;color:#d8d8d8;font-size:12px;font-weight:600}

        .form-group-custom .form-control,
        .form-group-custom .form-select{
            width:100%;
            min-height:48px;
            border:1px solid rgba(255,255,255,.14)!important;
            border-radius:10px!important;
            background:#202020!important;
            color:#fff!important;
            font-size:13px;
            color-scheme:dark;
        }

        .form-group-custom .form-control:focus,
        .form-group-custom .form-select:focus{
            border-color:#d5ad55!important;
            background:#222!important;
            color:#fff!important;
            box-shadow:0 0 0 .2rem rgba(213,173,85,.08)!important;
        }

        .form-group-custom .form-select option{background:#202020;color:#fff}
        .form-error{margin-top:6px;color:#efa0a7;font-size:11px}

        .estado-dia{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:16px;border:1px solid rgba(255,255,255,.08);border-radius:12px;background:#1d1d1d}
        .estado-dia strong{display:block;color:#eee;font-size:12px;font-weight:600}
        .estado-dia span{display:block;margin-top:4px;color:#999;font-size:10px;line-height:1.4}

        .form-check-input{width:2.4em!important;height:1.2em!important;cursor:pointer}
        .form-check-input:checked{border-color:#d5ad55!important;background-color:#d5ad55!important}
        .form-check-input:focus{box-shadow:0 0 0 .2rem rgba(213,173,85,.08)!important}

        .horas-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;transition:.2s ease}
        .horas-grid.disabled{opacity:.35;pointer-events:none}

        .closed-message{display:none;align-items:center;gap:9px;margin-top:15px;padding:13px 14px;border:1px solid rgba(213,173,85,.15);border-radius:10px;background:rgba(213,173,85,.06);color:#c8c8c8;font-size:11px;line-height:1.5}
        .closed-message span{color:#ddb65a}
        .closed-message.show{display:flex}

        .horario-form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:28px;padding-top:22px;border-top:1px solid rgba(255,255,255,.07)}
        .btn-form-primary,.btn-form-secondary{min-height:44px;display:inline-flex;align-items:center;justify-content:center;padding:0 18px;border-radius:10px;font-size:12px;font-weight:600;text-decoration:none;transition:.2s}
        .btn-form-primary{border:1px solid #d5ad55;background:#d5ad55;color:#111}
        .btn-form-primary:hover{border-color:#e8c873;background:#e8c873;color:#111}
        .btn-form-secondary{border:1px solid rgba(255,255,255,.14);background:#202020;color:#bbb}
        .btn-form-secondary:hover{border-color:rgba(213,173,85,.25);color:#fff}

        @media(max-width:992px){
            .horario-form-content{grid-template-columns:1fr}
        }

        @media(max-width:600px){
            .horario-page-header{align-items:flex-start;flex-direction:column}
            .horario-form-card{padding:22px}
            .form-section{padding:18px}
            .horas-grid{grid-template-columns:1fr}
            .horario-form-actions{flex-direction:column-reverse}
            .btn-form-primary,.btn-form-secondary,.btn-volver{width:100%}
        }
    </style>
@endpush

@section('content')

    <div class="horario-page-header">
        <div class="page-header mb-0">
            <h1>Nuevo horario</h1>
            <p>Configura un nuevo día y horario de atención.</p>
        </div>

        <a href="{{ route('administrador.horarios.index') }}" class="btn-volver">
            Volver
        </a>
    </div>

    <div class="horario-form-card">
        <form method="POST" action="{{ route('administrador.horarios.store') }}">
            @csrf
            @include('administrador.horarios.form')
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cerrado=document.getElementById('cerrado');
            const horas=document.getElementById('horasContainer');
            const apertura=document.getElementById('hora_apertura');
            const cierre=document.getElementById('hora_cierre');
            const mensaje=document.getElementById('closedMessage');

            const actualizarEstado=()=>{
                if(!cerrado) return;

                if(cerrado.checked){
                    horas?.classList.add('disabled');
                    mensaje?.classList.add('show');
                    if(apertura) apertura.disabled=true;
                    if(cierre) cierre.disabled=true;
                } else {
                    horas?.classList.remove('disabled');
                    mensaje?.classList.remove('show');
                    if(apertura) apertura.disabled=false;
                    if(cierre) cierre.disabled=false;
                }
            };

            cerrado?.addEventListener('change', actualizarEstado);
            actualizarEstado();
        });
    </script>
@endpush
