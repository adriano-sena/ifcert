
@extends('layout')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Atividades </h3>
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-12 text-left mb-2">
                               <a href="{{route('atividades-form')}}">
                                   <button class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Criar Atividade
                                   </button>
                               </a>
                           </div>

                           <div class="table-responsive">
                               <table class="table">
                                   <thead class="thead-light">
                                       <tr>
                                           <th scope="col">Nome</th>
                                           <th scope="col">Data</th>
                                           <th scope="col">Vagas</th>
                                           <th scope="col">Local</th>
                                           <th scope="col" class="text-right">Ações</th>
                                       </tr>
                                   </thead>

                                   <tbody>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hands on Git-Github</td>
                                        <td>27/10/18</td>
                                        <td>40</td>
                                        <td>Laboratório informática 1</td>
                                        <td class="text-right">
                                         <a href="#Edit" title="Editar">
                                             <button class="btn btn-success">
                                              <i class="fa fa-magic"></i>
                                             </button>
                                         </a>  
                                         <a href="#Atividades" title="Atividades">
                                             <button class="btn btn-primary">
                                              <i class="fas fa-book"></i>
                                             </button>
                                         </a>  
                                         <a href="#Edit" title="Deletar">
                                             <button class="btn btn-danger">
                                              <i class="fa fa-trash"></i>
                                             </button>
                                         </a>  
                                        </td>
                                    </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection