using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;

namespace WpfLoginChat
{
    public class MonitorPasswordProperty : BaseAttachedProperty<MonitorPasswordProperty, bool>
    {
        //override OnvalueChanged
        public override void OnValueChnaged(DependencyObject sender, DependencyPropertyChangedEventArgs e)
        {
            //Get the Caller
            var passwordBox = sender as PasswordBox;

            //Make sure it is a password box
            if(passwordBox == null)
                return;

            //Remove any previous events
            passwordBox.PasswordChanged -= PasswordBox_PasswordChanged;

            //if the caller set MonitorPassword to true...
            if ((bool) e.NewValue)
            {
                //set default value
                HasTextProperty.SetValue(passwordBox, passwordBox.SecurePassword.Length > 0);

                //start listening out of the password changes
                passwordBox.PasswordChanged += PasswordBox_PasswordChanged;
            }
        }

        private void PasswordBox_PasswordChanged(object sender, RoutedEventArgs e)
        {
            HasTextProperty.SetValue((PasswordBox)sender);
        }
    }
    //the HasText atached property for a 'PasswordBox'
    public class HasTextProperty : BaseAttachedProperty<HasTextProperty, bool>
    {
        //set the HasText property based on if the caller 'Password' has any box
        public static void SetValue(DependencyObject sender)
        {
            HasTextProperty.SetValue(sender,((PasswordBox)sender).SecurePassword.Length > 0);
        }
    }
}
