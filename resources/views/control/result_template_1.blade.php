@extends('layouts.app')

@section('page_title')
    Temp 1
@endsection


@section('page_content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
         <p style="page-break-before: always">
          <div class="card">


              <div class="card-body">

                           <div style="border: solid thin #CCC" class="mb-1 p-2">   <table class="" width="100%">

                        <tr>
                            <th>
                              <table width="100%"><tr><td>
                                    <img width="100" class="img-rounded" src="">
                                  </td>
                                <td width="50%">

                                  <div class="text-center">
                                    <h1 style="font-size: 25px; font-weight:bold;">{{user()->school->name}}</h1>
                                    <p>{{user()->school->address}} </p>
                                    <h3 style="font-size: 15px; font-weight:bold;">TERMLY CONTINOUS ASSESSMENT DOSSIER </h3>
                                    <h3 style="font-size: 15px; font-weight:bold;">ACADEMIC SESSION </h3>
                                  </div>
                                </td>
                                <td width="25%"></td>
                                </tr>
                                </table>
                              </th>
                              </tr>

                              </table></div>

                 <table class="table table-bordered mb-1">
                      <thead>
                        <tr>
                            <td colspan="4"><b>Name:</b>Thomas Onyemechi</td>
                            <td colspan="4"><b>Class:</b> Jss1</td>
                            <td colspan="4"><b>Gender:</b> Male</td>
                        </tr>
                    </thead>
                  </table>

                  <table class="table table-bordered mb-1">
                    <thead>
                      <tr>
                        <th>Subjects</th>
                        <th>CA1</th>
                        <th>CA2</th>
                        <th>CA3</th>
                        <th>CA</th>
                        <th>Exam</th>
                        <th>Term Total</th>
                        <th>Cum Av</th>
                        <th>Class Av</th>
                        <th>Grade</th>
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>

                         <tr class="odd gradeX">
                            <td class="center">English</td>
                          <td class="center">10</td>
                            <td class="center">8</td>
                            <td class="center">20</td>
                            <td class="center">60</td>
                            <td class="center">65</td>
                            <td class="center">10</td>
                            <td class="center">33</td>
                            <td class="center">34</td>
                            <td class="center">56</td>
                            <td class="center">A</td>
                        </tr>
                    </tbody>

                   </table>

                  <table class="table table-bordered">
                   <tfoot>
                        <tr>
                            <th colspan="2">Subjects:  3</th>
                            <th colspan="2">Total Score: 345</th>
                            <th colspan="2">Average: 300</th>
                            <th colspan="2">Class Average: 290</th>
                            <th colspan="2">No in class: 20</th>
                        </tr>
                    </tfoot>
                  </table>
                   <table class="table table-bordered mt-1" width="100%">
                   <tfoot>
                        <tr>
                            <th>
                                <div class="row" >
                                     <div class="col-md-12 p-2">
                        <div class="float-left">
                          <b>This Term Vacation Date: </b>10, Jan 2022
                        </div>
                        <div class="float-right">
                          <b>Next Term Resumption Date: </b>10, Jan 2022
                        </div>
                      </div>

                      <div class="col-md-12 p-2">
                        <div class="float-left">
                          <b>Class Teacher's Comment/Signature/Date: </b><br/>2345678765
                        </div>
                        <div class="float-right">
                          <b>Principal/Head Teacher's Comment/Signature/Date: </b><br>Helloe world
                        </div>
                        </div>
                    </th>
                    </tr>
                    </tfoot>
                  </table>
              </div>
          </div>
         </p>
       </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection

