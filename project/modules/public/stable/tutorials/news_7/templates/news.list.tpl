{foreach from=$ppo->arNews item=newsObject}
<h2>[{$newsObject->date_news|datei18n}]{$newsObject->title_news}
{if $ppo->writeEnabled}
<a href="{copixurl dest="admin|edit" id_news=$newsObject->id_news }">{copixicon type=update}</a>
<a href="{copixurl dest="admin|delete" id_news=$newsObject->id_news }">{copixicon type=delete}</a>
{/if}
</h2>
{$newsObject->summary_news}

<br />
{copixurl dest="show" id_news=$newsObject->id_news comments=list title_news=$newsObject->title_news assign=moreUrl}
{assign var=id_news value=$newsObject->id_news}
{copixzone process="comments|comment" id="module;group;action=show;id_news=$id_news"  required=false moreUrl=$moreUrl}

<br />
<a href="{$moreUrl}">Lire la suite</a>
{/foreach}

{if $ppo->writeEnabled}
<hr />
<a href="{copixurl dest="admin|edit" }">{copixicon type=new}Ajouter une nouvelle</a>
{/if}