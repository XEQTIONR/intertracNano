<table id ="table_id" class="table table-hover table-bordered">
<thead>
  <tr>
    {{--<th> Tyre ID </th>--}}
    <th> Brand </th>
    <th> Size </th>
    <th> Pattern </th>
    <th> LiSi </th>


    <th># in stock </th>
    <th></th>
  </tr>
</thead>
<tbody>
    <tr v-for="(item, index) in stock" v-if="item.in_stock>0" :id="index">

      {{--<td class="text-center">@{{item.tyre_id}}</td>--}}
      <td class="text-center">@{{item.brand}}</td>
      <td class="text-center">@{{item.size}}</td>
      <td class="text-center">@{{item.pattern}}</td>
      <td class="text-center">@{{item.lisi}}</td>

      <td class="text-center" :class="{'text-red' : helperStockLive(index)<0}">@{{helperStockLive(index)}}</td>
      <td v-if="!do_not_show">
        <a class="text-success" @click="add(index)">
          <i class="fas fa-plus-circle"></i>
        </a>
      </td>
    </tr>
</tbody>
</table>
