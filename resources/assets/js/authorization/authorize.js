import poilices from './policies';
export default {
    install (Vue, options) {
        //tạo hàm để gọi nhanh authorize('modify', answer)
        Vue.prototype.authorize = function(policy, model) {
            if (!window.Auth.signedIn) return false;
            if (typeof policy === 'string' && typeof model === 'object') {
                const user = window.Auth.user;
                return poilices[policy](user, model);
                //return policies.policy(user, model);
            }
        };

        Vue.prototype.signedIn = window.Auth.signedIn;
    }
}
