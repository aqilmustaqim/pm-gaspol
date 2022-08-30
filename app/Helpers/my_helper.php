<?php

function check_member($idteam, $iduser)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_team');
    $builder->select('*');
    $builder->where('id_team', $idteam);
    $builder->where('id_users', $iduser);
    $query = $builder->get();
    $access = $query->getResultArray();

    if ($access) {
        return "checked='checked'";
    }
}

function detailFotoTeam($idTeam)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_team');
    $builder->select('nama,foto');
    $builder->join('team', 'detail_team.id_team = team.id');
    $builder->join('users', 'detail_team.id_users = users.id');
    $builder->where('id_team', $idTeam);
    $query = $builder->get();
    $detailteam = $query->getResultArray();

    return $detailteam;
}
function jumlahMemberTeam($idTeam)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_team');
    $builder->selectCount('detail_team.id');
    $builder->where('id_team', $idTeam);
    $query = $builder->get();
    $jumlahMemberTeam = $query->getRowArray();

    return $jumlahMemberTeam;
}
