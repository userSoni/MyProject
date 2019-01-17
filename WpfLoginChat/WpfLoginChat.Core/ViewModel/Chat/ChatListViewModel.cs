using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.AccessControl;
using System.Text;
using System.Threading.Tasks;

namespace WpfLoginChat.Core
{
    //A view model for each chat list item in the overview chat list
    public class ChatListViewModel : BaseViewModel
    {
        //The display name of the chat list
        public List<ChatListItemViewModel> Items { get; set; }
    }
}
