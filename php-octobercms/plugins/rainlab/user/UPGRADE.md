# Upgrade guide

- [Upgrading to 1.1 from 1.0](#upgrade-1.1)
- [Upgrading to 1.4 from 1.3](#upgrade-1.4)

<a name="upgrade-1.1"></a>
## Upgrading To 1.1

The User plugin has been split apart in to smaller more manageable plugins. These fields are no longer provided by the User plugin: `company`, `phone`, `street_addr`, `city`, `zip`, `country`, `state`. This is a non-destructive upgrade so the columns will remain in the database untouched.

Country and State models have been removed and can be replaced by installing the plugin **RainLab.Location**. The remaining profiles fields can be replaced by installing the plugin **RainLab.UserPlus**.

In short, to retain the old functionaliy simply install the following plugins:

- RainLab.Location
- RainLab.UserPlus

<a name="upgrade-1.4"></a>
## Upgrading To 1.4

The Notifications tab in User settings has been removed. This feature has been replaced by the [Notify plugin](https://octobercms.com/plugin/rainlab-notify). How to replace this feature:

1. Install the `RainLab.Notify` plugin
1. Navigate to Settings > Notification rules
1. Click **New notification** rule
1. Select User > **Activated**
1. Click **Add action**
1. Select **Compose a mail message**
1. Select **User email address** for the **Send to field**
1. Here you may select the **Mail template** previously defined in the user settings.
1. Click **Save**
