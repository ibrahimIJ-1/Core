interface Channel {
    channelName: string;
    channelEvent?: string;
    callback?: Function;
}

export const register = ({ channelName, channelEvent, callback }: Channel) => {
    window.Echo.channel(channelName).listen(channelEvent, (e: any) => {
        callback ? callback() : null;
    });
};

export const registerPrivate = ({ channelName, channelEvent, callback }: Channel) => {
    window.Echo.private(channelName).listen(channelEvent, (e: any) => {
        callback ? callback() : null;
    });
};

export const unRegister = ({ channelName }: Channel): void => {
    window.Echo.leave(channelName);
};

