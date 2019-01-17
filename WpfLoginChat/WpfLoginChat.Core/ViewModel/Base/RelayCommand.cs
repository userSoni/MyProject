using System;
using System.Windows.Input;

namespace WpfLoginChat.Core.ViewModel
{
    public class RelayCommand : ICommand
    {
        private Action MAction;

        public event EventHandler CanExecuteChanged = (sender, e) => {};

        public RelayCommand(Action action)
        {
            MAction = action;
        }

        public bool CanExecute(object parameter)
        {
            return true;
        }

        public void Execute(object parameter)
        {
            MAction();
        }
    }
}
