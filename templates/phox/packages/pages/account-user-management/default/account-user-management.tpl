{include file="$template/includes/flashmessage.tpl"}

{include file="$template/includes/tablelist.tpl" tableName="UsersManagement"}

<script type="text/javascript">
jQuery(document).ready(function() {
  var table = jQuery('#tableUsersManagement').removeClass('hidden').DataTable();
  table.draw();
  jQuery('#tableLoading').addClass('hidden');
});
</script>

<div class="section">
  <div class="section-header">
    <h2 class="section-title">{lang key="userManagement.usersFound" count=$users->count()}</h2>
  </div>
  <div class="section-body">
    <div class="table-container clearfix">
      <table id="tableUsersManagement" class="table table-list display responsive nowrap hidden">
        <thead>
          <tr>
            <th>{lang key="userManagement.emailAddress"} / {lang key="userManagement.lastLogin"}</th>
            <th width="300">{lang key="userManagement.actions"}</th>
          </tr>
        </thead>
        <tbody>
          {foreach $users as $user}
            <tr>
              <td width="50%">
                {$user->email}
                {if $user->pivot->owner}
                  <span class="label label-info">{lang key="clientOwner"}</span>
                {/if}
                {if $user->hasTwoFactorAuthEnabled()}
                  <i class="fad fa-shield text-success" data-toggle="tooltip" data-placement="auto right"
                    title="{lang key='twoFactor.enabled'}"></i>
                {else}
                  <i class="fad fa-shield text-grey" data-toggle="tooltip" data-placement="auto right"
                    title="{lang key='twoFactor.disabled'}"></i>
                {/if}
                <br>
                <small>
                  {lang key="userManagement.lastLogin"}:
                  {if $user->pivot->hasLastLogin()}
                    {$user->pivot->getLastLogin()->diffForHumans()}
                  {else}
                    {$LANG.never}
                  {/if}
                </small>
              </td>
              <td class="text-right">
                <a href="{routePath('account-users-permissions', $user->id)}"
                  class="btn btn-default btn-sm btn-manage-permissions" {if $user->pivot->owner} disabled="disabled" {/if}>
                  {lang key="userManagement.managePermissions"}
                </a>
                <a href="#" class="btn btn-danger btn-sm btn-remove-user" data-id="{$user->id}" {if $user->pivot->owner}
                  disabled="disabled" {/if}>
                  {lang key="userManagement.removeAccess"}
                </a>
              </td>
            </tr>
          {/foreach}
          {if $invites->count() > 0}
            <tr>
              <td colspan="3">
                <strong>{lang key="userManagement.pendingInvites"}</strong>
              </td>
            </tr>
            {foreach $invites as $invite}
              <tr>
                <td>
                  {$invite->email}
                  <br>
                  <small>
                    {lang key="userManagement.inviteSent"}:
                    {$invite->created_at->diffForHumans()}
                  </small>
                </td>
                <td>
                  <form method="post" action="{routePath('account-users-invite-resend')}">
                    <input type="hidden" name="inviteid" value="{$invite->id}">
                    <button type="submit" class="btn btn-default btn-sm">
                      {lang key="userManagement.resendInvite"}
                    </button>
                    <button type="button" class="btn btn-default btn-sm btn-cancel-invite" data-id="{$invite->id}">
                      {lang key="userManagement.cancelInvite"}
                    </button>
                  </form>
                </td>
              </tr>
            {/foreach}
          {/if}
        </tbody>
      </table>
    </div>
    <p class="text-small">* {lang key="userManagement.accountOwnerPermissionsInfo"}</p>
  </div>
</div>



<div class="section">
  <div class="section-header">
    <h2 class="section-title">{lang key="userManagement.inviteNewUser"}</h2>
  </div>
  <div class="section-body">
    <div class="panel panel-form">
      <div class="panel-body">
      <div class="mb-spacer-2x"><p>{lang key="userManagement.inviteNewUserDescription"}</p></div>
      <form method="post" action="{routePath('account-users-invite')}">
        <div class="form-group">
          <input type="email" name="inviteemail" placeholder="name@example.com" class="form-control"
            value="{$formdata.inviteemail}">
        </div>
        <div class="form-group">
          <label class="radio-inline">
            <input type="radio" name="permissions" value="all" checked="checked">
            {lang key="userManagement.allPermissions"}
          </label>
          <label class="radio-inline">
            <input type="radio" name="permissions" value="choose">
            {lang key="userManagement.choosePermissions"}
          </label>
        </div>
        <div class="hidden" id="invitePermissions">
          {foreach $permissions as $permission}
            <label class="checkbox">
              <input type="checkbox" name="perms[{$permission.key}]" value="1">
              {$permission.title}
              -
              {$permission.description}
            </label>
          {/foreach}
        </div>
        <button type="submit" class="btn btn-info">
          {lang key="userManagement.sendInvite"}
        </button>
      </form>
      </div>
    </div>
  </div>
</div>

<form method="post" action="{routePath('user-accounts')}">
  <input type="hidden" name="id" value="" id="inputSwitchAcctId">
</form>

<form method="post" action="{routePath('account-users-remove')}">
  <input type="hidden" name="userid" id="inputRemoveUserId">
  <div class="modal fade" id="modalRemoveUser">
    <div class="modal-dialog">
      <div class="modal-content panel-primary">
        <div class="modal-header panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">
            {lang key="userManagement.removeAccess"}
          </h4>
        </div>
        <div class="modal-body">
          <p>{lang key="userManagement.removeAccessSure"}</p>
          <p>{lang key="userManagement.removeAccessInfo"}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            {lang key="cancel"}
          </button>
          <button type="submit" class="btn btn-primary" id="btnRemoveUserConfirm">
            {lang key="confirm"}
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<form method="post" action="{routePath('account-users-invite-cancel')}">
  <input type="hidden" name="inviteid" id="inputCancelInviteId">
  <div class="modal fade" id="modalCancelInvite">
    <div class="modal-dialog">
      <div class="modal-content panel-primary">
        <div class="modal-header panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">
            {lang key="userManagement.cancelInvite"}
          </h4>
        </div>
        <div class="modal-body">
          <p>{lang key="userManagement.cancelInviteSure"}</p>
          <p>{lang key="userManagement.cancelInviteInfo"}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            {lang key="cancel"}
          </button>
          <button type="submit" class="btn btn-primary" id="btnCancelInviteConfirm">
            {lang key="confirm"}
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  jQuery(document).ready(function() {
    jQuery('input:radio[name=permissions]').change(function() {
      if (this.value === 'choose') {
        jQuery('#invitePermissions').hide().removeClass('hidden').slideDown();
      } else {
        jQuery('#invitePermissions').slideUp();
      }
    });
    jQuery('.btn-manage-permissions').click(function(e) {
      if (jQuery(this).attr('disabled')) {
        e.preventDefault();
      }
    });
    jQuery('.btn-remove-user').click(function(e) {
      e.preventDefault();
      if (jQuery(this).attr('disabled')) {
        return;
      }
      jQuery('#inputRemoveUserId').val(jQuery(this).data('id'));
      jQuery('#modalRemoveUser').modal('show');
    });
    jQuery('.btn-cancel-invite').click(function(e) {
      e.preventDefault();
      jQuery('#inputCancelInviteId').val(jQuery(this).data('id'));
      jQuery('#modalCancelInvite').modal('show');
    });
  });
</script>