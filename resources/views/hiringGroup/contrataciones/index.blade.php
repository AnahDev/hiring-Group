 @extends('layouts.app')

 @section('content')
     <div class="container">
         <h2>Contratación de Postulantes</h2>
         <table class="table table-bordered">
             <thead>
                 <tr>
                     <th>ID de Postulación</th>
                     <th>Profesión</th>
                     <th>Oferta</th>
                     <th>Empresa</th>
                     <th>Fecha de Postulación</th>
                     <th>Acciones</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($postulaciones as $postulacion)
                     <tr>
                         <td>{{ $postulacion->id ?? '-' }}</td>
                         <td>{{ $postulacion->ofertaLaboral->profesion->descripcion ?? '-' }}</td>
                         <td>{{ $postulacion->ofertaLaboral->cargo ?? '-' }}</td>
                         <td>{{ $postulacion->ofertaLaboral->empresa->nombre ?? '-' }}</td>
                         <td>{{ $postulacion->fechaPostulacion ?? '-' }}</td>
                         <td>
                             <a href="{{ route('hiringGroup.contrataciones.show', $postulacion->ofertaLaboral->id) }}">Ver
                                 Oferta</a>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 @endsection
