using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Input;
using WpfLoginChat.Core.ViewModel;
using WpfLoginChat.DataModels;
using WpfLoginChat.ViewModel;

namespace WpfLoginChat.Core
{
    public class LoginViewModel : BaseViewModel
    {
        //The email of the user
        public string Email { get; set; }

        //A flag indicating if the login command is running
        public bool LoginIsRunning { get; set; }

        //The command to login
        public ICommand LoginCommand { get; set; }

        //The command to register
        public ICommand RegisterCommand { get; set; }

        public LoginViewModel()
        {
            LoginCommand = new RelayParameterizedCommand(async (parameter) => await Login(parameter));
            RegisterCommand = new RelayCommand(async () => await RegisterAsync());
        }

        public async Task Login(object parameter)
        {
            await RunCommandAsync(() => this.LoginIsRunning, async () =>
            {
                await Task.Delay(5000);

                var email = Email;

                //IMPORTANT: Never store unsecure password in variable like this
                var pass = (parameter as IHavePassword).SecurePassword.Unsecure();
            });

        }

        //Takes the users to the register page
        public async Task RegisterAsync()
        {
            //((WindowViewModel) ((MainWindow) Application.Current.MainWindow).DataContext).CurrentPage =ApplicationPage.Register;
            await Task.Delay(1);
        }

    }
}
