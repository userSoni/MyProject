using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.AccessControl;
using System.Text;
using System.Threading.Tasks;

namespace WpfLoginChat.Core
{
    //A view model for each chat list item in the overview chat list
    public class ChatListItemViewModel : BaseViewModel
    {
        //The display name of the chat list
        public string Name { get; set; }

        //The latest message from this chat
        public string Message { get; set; }

        //The initials to show for the profile picture background
        public string Initials { get; set; }

        //The RGB values (in hex) for the background color of the profile picture
        //For example FF00FF for Red and Blue mixed
        public string ProfilePictureRGB { get; set; }

        public bool NewContentAvailable { get; set; }

        public bool IsSelected { get; set; }
    }
}
