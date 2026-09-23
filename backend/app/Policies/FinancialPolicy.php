<?php
namespace App\Policies;
use App\Models\User;
class FinancialPolicy extends ManagementPolicy { public function viewAny(User $user):bool{return $user->can('financials.manage');} public function view(User $user):bool{return $this->viewAny($user);} public function create(User $user):bool{return $this->viewAny($user);} public function update(User $user):bool{return $this->viewAny($user);} public function delete(User $user):bool{return false;} }
