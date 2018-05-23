<tr id={{$user->username}}>
    <th class="text-left" scope="row">{{$user->id}}
    </th>
    <td class="text-right">{{$user->username}}
    </td>
    <td class="text-right">{{$user->permission}}
    </td>
    <td class="text-right">{{$user->email}}
    </td>
    <td class="text-right">{{$user->points}}
    </td>
    <td class="text-right">
        @if($user->permission=='moderator')
        <i class="text-danger fas fa-angle-double-down mr-1 demote" data-toggle="tooltip" title="Demote user"></i>
        @endif
        @if($user->permission=='moderator' || $user->permission=='normal')
        <i class="text-success fas fa-angle-double-up mr-1 promote" data-toggle="tooltip" title="Promote user"></i>
        <i class="text-danger fas fa-ban ban" data-toggle="modal" data-target="#banModal" title="Ban user"></i>
        @endif
    </td>
</tr>