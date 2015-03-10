GlobalHandle
============

Adds a new Global Handle to layouts to override anything as a final layout directive

Magento's default layout loading order is as such:

     default
     STORE_bare_us
     THEME_frontend_default_default
     helloworld_index_index
     customer_logged_out

The issue is that there is no 'last' global layout handle that allows you to make a change to any previous layout directive.<br/>
An example of such a requirement is to have the ability to globally change all the root templates<br/>

This module simply injects a new layout handle as the last layout handle called 

    <GLOBAL_OVERRIDE>

Using this, it is, for example possible to override all page layouts to one base template, as apart from having to refer to eache handle seperately.

    <GLOBAL_OVERRIDE>
        <reference name="root">
            <action method="setTemplate"><template>page/3columns.phtml</template></action>
            <action method="setIsHandle"><applied>1</applied></action>
        </reference>
    </GLOBAL_OVERRIDE>


This then effectively makes the entire site 2columns-left, and no page is accidentally missed, and display in the wrong column structure.<br/>

The following handles are also now injected:<br/><br/>

CMS_<PAGE_NAME> example CMS_about_us<br/>
CATEGORY_<name> example CATEGORY_best_sellers<br/>

DYNAMIC HANDLE<br/>
Inject a new handle based on the given GET or POST variable called 'dynamic'
An example would be to inject a new handle to display a custom registration page
In this example we called it 'slim'

    /customer/account/create/dynamic/slim/ is the url used

which will inject a new handle called : slim_dynamic_handle which you can target via layout xml:

    <slim_dynamic_handle translate="label">
        <update name="customer_account_create"/>
        <label>Customer Account Slim Registration Form</label>
        <!-- Mage_Customer -->
        <remove name="right"/>
        <remove name="left"/>
        <remove name="header"/>
        <remove name="footer"/>
        <reference name="head">
            <action method="addCss"><stylesheet>css/slim.css</stylesheet></action>
        </reference>
        <reference name="root">
            <action method="setTemplate"><template>page/1column.phtml</template></action>
        </reference>
        <reference name="customer_form_register">
            <action method="setTemplate"><template>customer/form/slim.phtml</template></action>
        </reference>
    </slim_dynamic_handle>


The end result of the above would be a scaled down version of the account registration,
with its own template file, css etc





