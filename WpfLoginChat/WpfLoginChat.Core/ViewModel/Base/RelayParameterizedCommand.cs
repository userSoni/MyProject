using System;
using System.Windows.Input;

namespace WpfLoginChat.Core
{
    //A basic command that runs an Action
    public class RelayParameterizedCommand : ICommand
    {
        //The action to run
        private Action<object> mAction;

        //The event thats fired when the "CanExecute(object)" value has changed
        public event EventHandler CanExecuteChanged = (sender, e) => {};

        //Default constructor
        public RelayParameterizedCommand(Action<object> action)
        {
            mAction = action;
        }

        //A relay command can always execute
        public bool CanExecute(object parameter)
        {
            return true;
        }

        //Execute the commands Action
        public void Execute(object parameter)
        {
            mAction(parameter);
        }
    }
}
