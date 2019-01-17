using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WpfLoginChat.Core
{
    public class ChatListDesignModel : ChatListViewModel
    {
        //single instance of the class design model
        public static ChatListDesignModel Instance => new ChatListDesignModel();

        public ChatListDesignModel()
        {
            Items = new List<ChatListItemViewModel>
            {
                new ChatListItemViewModel
                {
                    Initials = "SA",
                    Name = "Soniya",
                    Message = "This chat is awesome !...",
                    ProfilePictureRGB = "ADD0E6",
                    NewContentAvailable = true
                },
                new ChatListItemViewModel
                {
                    Initials = "KM",
                    Name = "Kim",
                    Message = "This chat is awesome !...",
                    ProfilePictureRGB = "ff80ff",
                },
                new ChatListItemViewModel
                {
                    Initials = "RN",
                    Name = "Ronny",
                    Message = "This chat is awesome !...",
                    ProfilePictureRGB = "8080ff",
                    IsSelected = true
                },
                new ChatListItemViewModel
                {
                    Initials = "TB",
                    Name = "Tobias",
                    Message = "This chat is awesome !...",
                    ProfilePictureRGB = "80ffff",                },
                new ChatListItemViewModel
                {
                    Initials = "NO",
                    Name = "Noree",
                    Message = "This chat is awesome !...",
                    ProfilePictureRGB = "ffdf80",
                },
            };
        }
    }
}